<?php

namespace rapidPHP\plugin\qrcode;

use Exception;

class QREncode
{

    public $caseSensitive = true;

    public $eightBit = false;

    public $version = 0;

    public $size = 3;

    public $margin = 4;

    public $level = QR_ECLEVEL_L;

    public $hint = QR_MODE_8;

    public static function factory($level = QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        $enc = new QREncode();
        $enc->size = $size;
        $enc->margin = $margin;

        switch ($level . '') {
            case '0':
            case '1':
            case '2':
            case '3':
                $enc->level = $level;
                break;
            case 'l':
            case 'L':
                $enc->level = QR_ECLEVEL_L;
                break;
            case 'm':
            case 'M':
                $enc->level = QR_ECLEVEL_M;
                break;
            case 'q':
            case 'Q':
                $enc->level = QR_ECLEVEL_Q;
                break;
            case 'h':
            case 'H':
                $enc->level = QR_ECLEVEL_H;
                break;
        }

        return $enc;
    }

    /**
     * @param $inText
     * @param bool $outfile
     * @return mixed
     * @throws Exception
     */
    public function encodeRAW($inText, $outfile = false)
    {
        $code = new QRcode();

        if ($this->eightBit) {
            $code->encodeString8bit($inText, $this->version, $this->level);
        } else {
            $code->encodeString($inText, $this->version, $this->level, $this->hint, $this->caseSensitive);
        }

        return $code->data;
    }

    /**
     * @param $inText
     * @param bool $outfile
     * @return mixed
     * @throws Exception
     */
    public function encode($inText, $outfile = false)
    {
        $code = new QRcode();

        if ($this->eightBit) {
            $code->encodeString8bit($inText, $this->version, $this->level);
        } else {
            $code->encodeString($inText, $this->version, $this->level, $this->hint, $this->caseSensitive);
        }

        if ($outfile !== false) {
            $data = QRTools::binarize($code->data);

            file_put_contents($outfile, join("\n", $data));

            return $data;
        } else {
            return QRTools::binarize($code->data);
        }
    }

    public function encodePNG($inText, $outfile = false, $saveAndPrint = false)
    {
        try {

            ob_start();

            $tab = $this->encode($inText);

            ob_get_contents();

            ob_end_clean();

            $maxSize = (int)(QR_PNG_MAXIMUM_SIZE / (count($tab) + 2 * $this->margin));

            QRImage::png($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $saveAndPrint);

        } catch (Exception $e) {
        }
    }
}
