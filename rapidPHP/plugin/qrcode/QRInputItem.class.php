<?php

namespace rapidPHP\plugin\qrcode;

use Exception;

class QRInputItem
{

    public $mode;

    public $size;

    public $data;

    public $bStream;

    /**
     * QRInputItem constructor.
     * @param $mode
     * @param $size
     * @param $data
     * @param null $bStream
     * @throws Exception
     */
    public function __construct($mode, $size, $data, $bStream = null)
    {
        $setData = array_slice($data, 0, $size);

        if (count($setData) < $size) {
            $setData = array_merge($setData, array_fill(0, $size - count($setData), 0));
        }

        if (!QRInput::check($mode, $size, $setData))
            throw new Exception('Error m:' . $mode . ',s:' . $size . ',d:' . join(',', $setData));

        $this->mode = $mode;
        $this->size = $size;
        $this->data = $setData;
        $this->bStream = $bStream;
    }

    public function encodeModeNum($version)
    {
        try {

            $words = (int)($this->size / 3);
            $bs = new QRBitStream();

            $val = 0x1;
            $bs->appendNum(4, $val);
            $bs->appendNum(QRSpec::lengthIndicator(QR_MODE_NUM, $version), $this->size);

            for ($i = 0; $i < $words; $i++) {
                $val = (ord($this->data[$i * 3]) - ord('0')) * 100;
                $val += (ord($this->data[$i * 3 + 1]) - ord('0')) * 10;
                $val += (ord($this->data[$i * 3 + 2]) - ord('0'));
                $bs->appendNum(10, $val);
            }

            if ($this->size - $words * 3 == 1) {
                $val = ord($this->data[$words * 3]) - ord('0');
                $bs->appendNum(4, $val);
            } else if ($this->size - $words * 3 == 2) {
                $val = (ord($this->data[$words * 3]) - ord('0')) * 10;
                $val += (ord($this->data[$words * 3 + 1]) - ord('0'));
                $bs->appendNum(7, $val);
            }

            $this->bStream = $bs;
            return 0;

        } catch (Exception $e) {
            return -1;
        }
    }

    public function encodeModeAn($version)
    {
        try {
            $words = (int)($this->size / 2);
            $bs = new QRBitStream();

            $bs->appendNum(4, 0x02);
            $bs->appendNum(QRSpec::lengthIndicator(QR_MODE_AN, $version), $this->size);

            for ($i = 0; $i < $words; $i++) {
                $val = (int)QRInput::lookAnTable(ord($this->data[$i * 2])) * 45;
                $val += (int)QRInput::lookAnTable(ord($this->data[$i * 2 + 1]));

                $bs->appendNum(11, $val);
            }

            if ($this->size & 1) {
                $val = QRInput::lookAnTable(ord($this->data[$words * 2]));
                $bs->appendNum(6, $val);
            }

            $this->bStream = $bs;
            return 0;

        } catch (Exception $e) {
            return -1;
        }
    }

    public function encodeMode8($version)
    {
        try {
            $bs = new QRBitStream();

            $bs->appendNum(4, 0x4);
            $bs->appendNum(QRSpec::lengthIndicator(QR_MODE_8, $version), $this->size);

            for ($i = 0; $i < $this->size; $i++) {
                $bs->appendNum(8, ord($this->data[$i]));
            }

            $this->bStream = $bs;
            return 0;

        } catch (Exception $e) {
            return -1;
        }
    }

    public function encodeModeKanji($version)
    {
        try {

            $bs = new QRBitStream();

            $bs->appendNum(4, 0x8);

            $bs->appendNum(QRSpec::lengthIndicator(QR_MODE_KANJI, $version), (int)($this->size / 2));

            for ($i = 0; $i < $this->size; $i += 2) {
                $val = (ord($this->data[$i]) << 8) | ord($this->data[$i + 1]);
                if ($val <= 0x9ffc) {
                    $val -= 0x8140;
                } else {
                    $val -= 0xc140;
                }

                $h = ($val >> 8) * 0xc0;
                $val = ($val & 0xff) + $h;

                $bs->appendNum(13, $val);
            }

            $this->bStream = $bs;
            return 0;

        } catch (Exception $e) {
            return -1;
        }
    }

    public function encodeModeStructure()
    {
        try {
            $bs = new QRBitStream();

            $bs->appendNum(4, 0x03);
            $bs->appendNum(4, ord($this->data[1]) - 1);
            $bs->appendNum(4, ord($this->data[0]) - 1);
            $bs->appendNum(8, ord($this->data[2]));

            $this->bStream = $bs;
            return 0;

        } catch (Exception $e) {
            return -1;
        }
    }

    public function estimateBitStreamSizeOfEntry($version)
    {
        if ($version == 0) $version = 1;

        switch ($this->mode) {
            case QR_MODE_NUM:
                $bits = QRInput::estimateBitsModeNum($this->size);
                break;
            case QR_MODE_AN:
                $bits = QRInput::estimateBitsModeAn($this->size);
                break;
            case QR_MODE_8:
                $bits = QRInput::estimateBitsMode8($this->size);
                break;
            case QR_MODE_KANJI:
                $bits = QRInput::estimateBitsModeKanji($this->size);
                break;
            case QR_MODE_STRUCTURE:
                return STRUCTURE_HEADER_BITS;
            default:
                return 0;
        }

        $l = QRSpec::lengthIndicator($this->mode, $version);

        $m = 1 << $l;

        $num = (int)(($this->size + $m - 1) / $m);

        $bits += $num * (4 + $l);

        return $bits;
    }

    public function encodeBitStream($version)
    {
        try {

            unset($this->bStream);
            $words = QRSpec::maximumWords($this->mode, $version);

            if ($this->size > $words) {

                $st1 = new QRInputItem($this->mode, $words, $this->data);
                $st2 = new QRInputItem($this->mode, $this->size - $words, array_slice($this->data, $words));

                $st1->encodeBitStream($version);
                $st2->encodeBitStream($version);

                $this->bStream = new QRBitStream();
                $this->bStream->append($st1->bStream);
                $this->bStream->append($st2->bStream);

                unset($st1);
                unset($st2);

            } else {

                $ret = 0;

                switch ($this->mode) {
                    case QR_MODE_NUM:
                        $ret = $this->encodeModeNum($version);
                        break;
                    case QR_MODE_AN:
                        $ret = $this->encodeModeAn($version);
                        break;
                    case QR_MODE_8:
                        $ret = $this->encodeMode8($version);
                        break;
                    case QR_MODE_KANJI:
                        $ret = $this->encodeModeKanji($version);
                        break;
                    case QR_MODE_STRUCTURE:
                        $ret = $this->encodeModeStructure();
                        break;

                    default:
                        break;
                }

                if ($ret < 0)
                    return -1;
            }

            return $this->bStream->size();

        } catch (Exception $e) {
            return -1;
        }
    }
}