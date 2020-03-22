<?php

namespace rapidPHP\plugin\qrcode;

class QRStr
{
    public static function set(&$srcTab, $x, $y, $repl, $replLen = false)
    {
        $srcTab[$y] = substr_replace($srcTab[$y], ($replLen !== false) ? substr($repl, 0, $replLen) : $repl, $x, ($replLen !== false) ? $replLen : strlen($repl));
    }
}