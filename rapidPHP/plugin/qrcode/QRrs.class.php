<?php

namespace rapidPHP\plugin\qrcode;

class QRrs
{

    public static $items = array();

    public static function initRs($symSize, $gfPoly, $fcr, $prim, $nRoots, $pad)
    {
        foreach (self::$items as $rs) {
            if ($rs->pad != $pad) continue;

            if ($rs->nroots != $nRoots) continue;

            if ($rs->mm != $symSize) continue;

            if ($rs->gfpoly != $gfPoly) continue;

            if ($rs->fcr != $fcr) continue;

            if ($rs->prim != $prim) continue;

            return $rs;
        }

        $rs = QRRsItem::initRsChar($symSize, $gfPoly, $fcr, $prim, $nRoots, $pad);

        array_unshift(self::$items, $rs);

        return $rs;
    }
}
