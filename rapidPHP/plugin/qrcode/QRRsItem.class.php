<?php


namespace rapidPHP\plugin\qrcode;

class QRRsItem
{

    public $mm;

    public $nn;

    public $alpha_to = array();

    public $index_of = array();

    public $genPoly = array();

    public $nRoots;

    public $fcr;

    public $prim;

    public $ipRim;

    public $pad;

    public $gfPoly;

    public function modnn($x)
    {
        while ($x >= $this->nn) {
            $x -= $this->nn;
            $x = ($x >> $this->mm) + ($x & $this->nn);
        }

        return $x;
    }

    public static function initRsChar($symSize, $gfPoly, $fcr, $prim, $nRoots, $pad)
    {
        $rs = null;

        if ($symSize < 0 || $symSize > 8) return $rs;
        if ($fcr < 0 || $fcr >= (1 << $symSize)) return $rs;
        if ($prim <= 0 || $prim >= (1 << $symSize)) return $rs;
        if ($nRoots < 0 || $nRoots >= (1 << $symSize)) return $rs; // Can't have more roots than symbol values!
        if ($pad < 0 || $pad >= ((1 << $symSize) - 1 - $nRoots)) return $rs; // Too much padding

        $rs = new QRRsItem();
        $rs->mm = $symSize;
        $rs->nn = (1 << $symSize) - 1;
        $rs->pad = $pad;

        $rs->alpha_to = array_fill(0, $rs->nn + 1, 0);
        $rs->index_of = array_fill(0, $rs->nn + 1, 0);

        // PHP style macro replacement ;)
        $NN =& $rs->nn;
        $A0 =& $NN;

        // Generate Galois field lookup tables
        $rs->index_of[0] = $A0; // log(zero) = -inf
        $rs->alpha_to[$A0] = 0; // alpha**-inf = 0
        $sr = 1;

        for ($i = 0; $i < $rs->nn; $i++) {
            $rs->index_of[$sr] = $i;
            $rs->alpha_to[$i] = $sr;
            $sr <<= 1;
            if ($sr & (1 << $symSize)) {
                $sr ^= $gfPoly;
            }
            $sr &= $rs->nn;
        }

        if ($sr != 1) {
            // field generator polynomial is not primitive!
            $rs = NULL;
            return $rs;
        }

        /* Form RS code generator polynomial from its roots */
        $rs->genPoly = array_fill(0, $nRoots + 1, 0);

        $rs->fcr = $fcr;
        $rs->prim = $prim;
        $rs->nRoots = $nRoots;
        $rs->gfPoly = $gfPoly;

        /* Find prim-th root of 1, used in decoding */
        for ($iprim = 1; ($iprim % $prim) != 0; $iprim += $rs->nn)
            ; // intentional empty-body loop!

        $rs->ipRim = (int)($iprim / $prim);
        $rs->genPoly[0] = 1;

        for ($i = 0, $root = $fcr * $prim; $i < $nRoots; $i++, $root += $prim) {
            $rs->genPoly[$i + 1] = 1;

            // Multiply rs->genpoly[] by  @**(root + x)
            for ($j = $i; $j > 0; $j--) {
                if ($rs->genPoly[$j] != 0) {
                    $rs->genPoly[$j] = $rs->genPoly[$j - 1] ^ $rs->alpha_to[$rs->modnn($rs->index_of[$rs->genPoly[$j]] + $root)];
                } else {
                    $rs->genPoly[$j] = $rs->genPoly[$j - 1];
                }
            }
            // rs->genpoly[0] can never be zero
            $rs->genPoly[0] = $rs->alpha_to[$rs->modnn($rs->index_of[$rs->genPoly[0]] + $root)];
        }

        // convert rs->genpoly[] to index form for quicker encoding
        for ($i = 0; $i <= $nRoots; $i++)
            $rs->genPoly[$i] = $rs->index_of[$rs->genPoly[$i]];

        return $rs;
    }

    public function encode_rs_char($data, &$parity)
    {
        $NN =& $this->nn;

        $ALPHA_TO =& $this->alpha_to;

        $INDEX_OF =& $this->index_of;

        $GENPOLY =& $this->genPoly;

        $NROOTS =& $this->nRoots;

        $PAD =& $this->pad;
        
        $A0 =& $NN;

        $parity = array_fill(0, $NROOTS, 0);

        for ($i = 0; $i < ($NN - $NROOTS - $PAD); $i++) {

            $feedback = $INDEX_OF[$data[$i] ^ $parity[0]];
            if ($feedback != $A0) {
                $feedback = $this->modnn($NN - $GENPOLY[$NROOTS] + $feedback);

                for ($j = 1; $j < $NROOTS; $j++) {
                    $parity[$j] ^= $ALPHA_TO[$this->modnn($feedback + $GENPOLY[$NROOTS - $j])];
                }
            }

            // Shift
            array_shift($parity);
            if ($feedback != $A0) {
                array_push($parity, $ALPHA_TO[$this->modnn($feedback + $GENPOLY[0])]);
            } else {
                array_push($parity, 0);
            }
        }
    }
}