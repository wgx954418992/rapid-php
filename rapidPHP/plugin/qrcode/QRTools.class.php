<?php

namespace rapidPHP\plugin\qrcode;

class QRTools
{
    public static function binarize($frame)
    {
        $len = count($frame);

        foreach ($frame as &$frameLine) {

            for ($i = 0; $i < $len; $i++) {
                $frameLine[$i] = (ord($frameLine[$i]) & 1) ? '1' : '0';
            }
        }

        return $frame;
    }
}