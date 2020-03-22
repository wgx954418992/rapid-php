<?php

namespace rapidPHP\plugin\qrcode;

use Exception;

class QRInput
{

    public $items;

    private $version;

    private $level;

    /**
     * QRInput constructor.
     * @param int $version
     * @param int $level
     * @throws Exception
     */
    public function __construct($version = 0, $level = QR_ECLEVEL_L)
    {
        if ($version < 0 || $version > QRSPEC_VERSION_MAX || $level > QR_ECLEVEL_H) throw new Exception('Invalid version no');

        $this->version = $version;
        $this->level = $level;
    }


    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return int
     * @throws Exception
     */
    public function setVersion($version)
    {
        if ($version < 0 || $version > QRSPEC_VERSION_MAX) throw new Exception('Invalid version no');

        $this->version = $version;

        return 0;
    }


    public function getErrorCorrectionLevel()
    {
        return $this->level;
    }


    /**
     * @param $level
     * @return int
     * @throws Exception
     */
    public function setErrorCorrectionLevel($level)
    {
        if ($level > QR_ECLEVEL_H) throw new Exception('Invalid ECLEVEL');

        $this->level = $level;

        return 0;
    }

    /**
     * appendEntry
     * @param QRInputItem $entry
     */
    public function appendEntry(QRInputItem $entry)
    {
        $this->items[] = $entry;
    }

    /**
     * @param $mode
     * @param $size
     * @param $data
     * @return int
     */
    public function append($mode, $size, $data)
    {
        try {
            $entry = new QRInputItem($mode, $size, $data);

            $this->items[] = $entry;

            return 0;
        } catch (Exception $e) {
            return -1;
        }
    }


    /**
     * insertStructuredAppendHeader
     * @param $size
     * @param $index
     * @param $parity
     * @return int
     * @throws Exception
     */
    public function insertStructuredAppendHeader($size, $index, $parity)
    {
        if ($size > MAX_STRUCTURED_SYMBOLS) throw new Exception('insertStructuredAppendHeader wrong size');

        if ($index <= 0 || $index > MAX_STRUCTURED_SYMBOLS) throw new Exception('insertStructuredAppendHeader wrong index');

        $buf = array($size, $index, $parity);

        try {
            $entry = new QRInputItem(QR_MODE_STRUCTURE, 3, $buf);
            array_unshift($this->items, $entry);
            return 0;
        } catch (Exception $e) {
            return -1;
        }
    }


    public function calcParity()
    {
        $parity = 0;

        foreach ($this->items as $item) {
            if ($item->mode != QR_MODE_STRUCTURE) {
                for ($i = $item->size - 1; $i >= 0; $i--) {
                    $parity ^= $item->data[$i];
                }
            }
        }

        return $parity;
    }


    public static function checkModeNum($size, $data)
    {
        for ($i = 0; $i < $size; $i++) {
            if ((ord($data[$i]) < ord('0')) || (ord($data[$i]) > ord('9'))) {
                return false;
            }
        }

        return true;
    }


    public static function estimateBitsModeNum($size)
    {
        $w = (int)$size / 3;
        $bits = $w * 10;

        switch ($size - $w * 3) {
            case 1:
                $bits += 4;
                break;
            case 2:
                $bits += 7;
                break;
            default:
                break;
        }

        return $bits;
    }


    public static $anTable = array(
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        36, -1, -1, -1, 37, 38, -1, -1, -1, -1, 39, 40, -1, 41, 42, 43,
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 44, -1, -1, -1, -1, -1,
        -1, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
        25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1
    );


    public static function lookAnTable($c)
    {
        return (($c > 127) ? -1 : self::$anTable[$c]);
    }


    public static function checkModeAn($size, $data)
    {
        for ($i = 0; $i < $size; $i++) {
            if (self::lookAnTable(ord($data[$i])) == -1) {
                return false;
            }
        }

        return true;
    }


    public static function estimateBitsModeAn($size)
    {
        $w = (int)($size / 2);
        $bits = $w * 11;

        if ($size & 1) {
            $bits += 6;
        }

        return $bits;
    }


    public static function estimateBitsMode8($size)
    {
        return $size * 8;
    }


    public static function estimateBitsModeKanji($size)
    {
        return (int)(($size / 2) * 13);
    }


    public static function checkModeKanji($size, $data)
    {
        if ($size & 1)
            return false;

        for ($i = 0; $i < $size; $i += 2) {
            $val = (ord($data[$i]) << 8) | ord($data[$i + 1]);
            if ($val < 0x8140
                || ($val > 0x9ffc && $val < 0xe040)
                || $val > 0xebbf) {
                return false;
            }
        }

        return true;
    }

    /***********************************************************************
     * Validation
     *********************************************************************
     * @param $mode
     * @param $size
     * @param $data
     * @return bool
     */
    public static function check($mode, $size, $data)
    {
        if ($size <= 0)
            return false;

        switch ($mode) {
            case QR_MODE_NUM:
                return self::checkModeNum($size, $data);
                break;
            case QR_MODE_AN:
                return self::checkModeAn($size, $data);
                break;
            case QR_MODE_KANJI:
                return self::checkModeKanji($size, $data);
                break;
            case QR_MODE_STRUCTURE:
            case QR_MODE_8:
                return true;
                break;
            default:
                break;
        }

        return false;
    }

    /**
     * estimateBitStreamSize
     * @param $version
     * @return int
     */
    public function estimateBitStreamSize($version)
    {
        $bits = 0;

        /** @var QRInputItem $item */
        foreach ($this->items as  $item) {
            $bits += $item->estimateBitStreamSizeOfEntry($version);
        }

        return $bits;
    }


    public function estimateVersion()
    {
        $version = 0;

        do {
            $prev = $version;

            $bits = $this->estimateBitStreamSize($prev);

            $version = QRSpec::getMinimumVersion((int)(($bits + 7) / 8), $this->level);

            if ($version < 0) return -1;
        } while ($version > $prev);

        return $version;
    }


    public static function lengthOfCode($mode, $version, $bits)
    {
        $payload = $bits - 4 - QRSpec::lengthIndicator($mode, $version);
        switch ($mode) {
            case QR_MODE_NUM:
                $chunks = (int)($payload / 10);
                $remain = $payload - $chunks * 10;
                $size = $chunks * 3;
                if ($remain >= 7) {
                    $size += 2;
                } else if ($remain >= 4) {
                    $size += 1;
                }
                break;
            case QR_MODE_AN:
                $chunks = (int)($payload / 11);
                $remain = $payload - $chunks * 11;
                $size = $chunks * 2;
                if ($remain >= 6)
                    $size++;
                break;
            case QR_MODE_STRUCTURE:
            case QR_MODE_8:
                $size = (int)($payload / 8);
                break;
            case QR_MODE_KANJI:
                $size = (int)(($payload / 13) * 2);
                break;
            default:
                $size = 0;
                break;
        }

        $maxsize = QRSpec::maximumWords($mode, $version);
        if ($size < 0) $size = 0;
        if ($size > $maxsize) $size = $maxsize;

        return $size;
    }

    /**
     * createBitStream
     * @return int
     */
    public function createBitStream()
    {
        $total = 0;

        /** @var QRInputItem $item */
        foreach ($this->items as $item) {
            $bits = $item->encodeBitStream($this->version);

            if ($bits < 0)
                return -1;

            $total += $bits;
        }

        return $total;
    }

    /**
     * convertData
     * @return int
     * @throws Exception
     */
    public function convertData()
    {
        $ver = $this->estimateVersion();

        if ($ver > $this->getVersion()) $this->setVersion($ver);

        for (; ;) {
            $bits = $this->createBitStream();

            if ($bits < 0) return -1;

            $ver = QRSpec::getMinimumVersion((int)(($bits + 7) / 8), $this->level);

            if ($ver < 0) throw new Exception('WRONG VERSION');

            if ($ver > $this->getVersion()) {
                $this->setVersion($ver);
            } else {
                break;
            }
        }

        return 0;
    }

    /**
     * appendPaddingBit
     * @param $bStream
     * @return int
     */
    public function appendPaddingBit(QRBitStream &$bStream)
    {
        $bits = $bStream->size();

        $maxWords = QRSpec::getDataLength($this->version, $this->level);

        $maxBits = $maxWords * 8;

        if ($maxBits == $bits) return 0;

        if ($maxBits - $bits < 5) return $bStream->appendNum($maxBits - $bits, 0);

        $bits += 4;
        $words = (int)(($bits + 7) / 8);

        $padding = new QRBitStream();

        $ret = $padding->appendNum($words * 8 - $bits + 4, 0);

        if ($ret < 0) return $ret;

        $padLen = $maxWords - $words;

        if ($padLen > 0) {

            $padBuf = array();

            for ($i = 0; $i < $padLen; $i++) {
                $padBuf[$i] = ($i & 1) ? 0x11 : 0xec;
            }

            $ret = $padding->appendBytes($padLen, $padBuf);

            if ($ret < 0)
                return $ret;

        }

        $ret = $bStream->append($padding);

        return $ret;
    }


    /**
     * mergeBitStream
     * @return QRBitStream|null
     * @throws Exception
     */
    public function mergeBitStream()
    {
        if ($this->convertData() < 0) return null;

        $bStream = new QRBitStream();

        foreach ($this->items as $item) {
            $ret = $bStream->append($item->bStream);

            if ($ret < 0) return null;
        }

        return $bStream;
    }

    /**
     * getBitStream
     * @return QRBitStream|null
     * @throws Exception
     */
    public function getBitStream()
    {

        $bStream = $this->mergeBitStream();

        if ($bStream == null) return null;

        $ret = $this->appendPaddingBit($bStream);

        if ($ret < 0) return null;

        return $bStream;
    }

    /**
     * getByteStream
     * @return array|null
     * @throws Exception
     */
    public function getByteStream()
    {
        $bStream = $this->getBitStream();
        if ($bStream == null) {
            return null;
        }

        return $bStream->toByte();
    }
}