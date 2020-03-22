<?php

namespace rapidPHP\plugin\qrcode;

use Exception;

define('QR_MODE_NUL', -1);
define('QR_MODE_NUM', 0);
define('QR_MODE_AN', 1);
define('QR_MODE_8', 2);
define('QR_MODE_KANJI', 3);
define('QR_MODE_STRUCTURE', 4);

define('QR_ECLEVEL_L', 0);
define('QR_ECLEVEL_M', 1);
define('QR_ECLEVEL_Q', 2);
define('QR_ECLEVEL_H', 3);

define('QR_FORMAT_TEXT', 0);
define('QR_FORMAT_PNG', 1);

define('QRSPEC_VERSION_MAX', 40);
define('QRSPEC_WIDTH_MAX', 177);

define('QRCAP_WIDTH', 0);
define('QRCAP_WORDS', 1);
define('QRCAP_REMINDER', 2);
define('QRCAP_EC', 3);

define('QR_CACHEABLE', false);
define('QR_CACHE_DIR', false);
define('QR_LOG_DIR', false);

define('QR_FIND_BEST_MASK', true);

define('QR_FIND_FROM_RANDOM', 2);
define('QR_DEFAULT_MASK', 2);

define('QR_PNG_MAXIMUM_SIZE', 1024);

define('STRUCTURE_HEADER_BITS', 20);
define('MAX_STRUCTURED_SYMBOLS', 16);

define('N1', 3);
define('N2', 3);
define('N3', 40);
define('N4', 10);
class QRCode
{

    public $version;

    public $width;

    public $data;

    /**
     * encodeMask
     * @param QRinput $input
     * @param $mask
     * @return $this|null
     * @throws Exception
     */
    public function encodeMask(QRinput $input, $mask)
    {
        if ($input->getVersion() < 0 || $input->getVersion() > QRSPEC_VERSION_MAX) throw new Exception('wrong version');

        if ($input->getErrorCorrectionLevel() > QR_ECLEVEL_H) throw new Exception('wrong level');

        $raw = new QRRawCode($input);

        $version = $raw->version;
        $width = QRSpec::getWidth($version);
        $frame = QRSpec::newFrame($version);

        $filler = new FrameFiller($width, $frame);

        if (is_null($filler)) return NULL;

        for ($i = 0; $i < $raw->dataLength + $raw->eccLength; $i++) {
            $code = $raw->getCode();
            $bit = 0x80;
            for ($j = 0; $j < 8; $j++) {
                $addr = $filler->next();
                $filler->setFrameAt($addr, 0x02 | (($bit & $code) != 0));
                $bit = $bit >> 1;
            }
        }

        unset($raw);

        $j = QRSpec::getRemainder($version);

        for ($i = 0; $i < $j; $i++) {
            $addr = $filler->next();

            $filler->setFrameAt($addr, 0x02);
        }

        $frame = $filler->frame;

        unset($filler);

        $maskObj = new QRMask();

        if ($mask < 0) {

            if (QR_FIND_BEST_MASK) {
                $masked = $maskObj->mask($width, $frame, $input->getErrorCorrectionLevel());
            } else {
                $masked = $maskObj->makeMask($width, $frame, (intval(QR_DEFAULT_MASK) % 8), $input->getErrorCorrectionLevel());
            }
        } else {
            $masked = $maskObj->makeMask($width, $frame, $mask, $input->getErrorCorrectionLevel());
        }

        if ($masked == NULL) {
            return NULL;
        }

        $this->version = $version;
        $this->width = $width;
        $this->data = $masked;

        return $this;
    }

    /**
     * encodeInput
     * @param QRinput $input
     * @return $this|null
     * @throws Exception
     */
    public function encodeInput(QRinput $input)
    {
        return $this->encodeMask($input, -1);
    }

    /**
     * encodeString8bit
     * @param $string
     * @param $version
     * @param $level
     * @return $this|null
     * @throws Exception
     */
    public function encodeString8bit($string, $version, $level)
    {
        if ($string == NULL) throw new Exception('empty string!');

        $input = new QRInput($version, $level);

        if ($input == NULL) return NULL;

        $ret = $input->append($input, strlen($string), str_split($string));

        if ($ret < 0) {
            unset($input);

            return NULL;
        }
        return $this->encodeInput($input);
    }

    /**
     * @param $string
     * @param $version
     * @param $level
     * @param $hint
     * @param $caseSensitive
     * @return $this|null
     * @throws Exception
     */
    public function encodeString($string, $version, $level, $hint, $caseSensitive)
    {

        if ($hint != QR_MODE_8 && $hint != QR_MODE_KANJI) throw new Exception('bad hint');

        $input = new QRInput($version, $level);

        if ($input == NULL) return NULL;

        $ret = QRSplit::splitStringToQRInput($string, $input, $hint, $caseSensitive);

        if ($ret < 0) return NULL;

        return $this->encodeInput($input);
    }

    /**
     * @param $text
     * @param bool $outfile
     * @param int $level
     * @param int $size
     * @param int $margin
     * @param bool $saveAndPrint
     */
    public static function png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveAndPrint = false)
    {
        $enc = QREncode::factory($level, $size, $margin);

        $enc->encodePNG($text, $outfile, $saveAndPrint);
    }

    /**
     * @param $text
     * @param bool $outfile
     * @param int $level
     * @param int $size
     * @param int $margin
     * @return mixed
     * @throws Exception
     */
    public static function text($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        $enc = QREncode::factory($level, $size, $margin);

        return $enc->encode($text, $outfile);
    }

    /**
     * @param $text
     * @param bool $outfile
     * @param int $level
     * @param int $size
     * @param int $margin
     * @return mixed
     * @throws Exception
     */
    public static function raw($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        $enc = QREncode::factory($level, $size, $margin);

        return $enc->encodeRAW($text, $outfile);
    }
}
