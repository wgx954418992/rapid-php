<?php

namespace rapidPHP\plugin\qrcode;


class QRBitStream
{

    public $data = array();


    public function size()
    {
        return count($this->data);
    }

    public function allocate($setLength)
    {
        $this->data = array_fill(0, $setLength, 0);
        return 0;
    }

    public static function newFromNum($bits, $num)
    {
        $bstream = new QRBitStream();
        $bstream->allocate($bits);

        $mask = 1 << ($bits - 1);
        for ($i = 0; $i < $bits; $i++) {
            if ($num & $mask) {
                $bstream->data[$i] = 1;
            } else {
                $bstream->data[$i] = 0;
            }
            $mask = $mask >> 1;
        }

        return $bstream;
    }

    public static function newFromBytes($size, $data)
    {
        $bstream = new QRBitStream();
        $bstream->allocate($size * 8);
        $p = 0;

        for ($i = 0; $i < $size; $i++) {
            $mask = 0x80;
            for ($j = 0; $j < 8; $j++) {
                if ($data[$i] & $mask) {
                    $bstream->data[$p] = 1;
                } else {
                    $bstream->data[$p] = 0;
                }
                $p++;
                $mask = $mask >> 1;
            }
        }

        return $bstream;
    }

    public function append(QRBitStream $arg)
    {
        if (is_null($arg)) {
            return -1;
        }

        if ($arg->size() == 0) {
            return 0;
        }

        if ($this->size() == 0) {
            $this->data = $arg->data;
            return 0;
        }

        $this->data = array_values(array_merge($this->data, $arg->data));

        return 0;
    }

    public function appendNum($bits, $num)
    {
        if ($bits == 0)
            return 0;

        $b = QRBitStream::newFromNum($bits, $num);

        if (is_null($b))
            return -1;

        $ret = $this->append($b);
        unset($b);

        return $ret;
    }

    public function appendBytes($size, $data)
    {
        if ($size == 0)
            return 0;

        $b = QRBitStream::newFromBytes($size, $data);

        if (is_null($b))
            return -1;

        $ret = $this->append($b);
        unset($b);

        return $ret;
    }

    public function toByte()
    {

        $size = $this->size();

        if ($size == 0) {
            return array();
        }

        $data = array_fill(0, (int)(($size + 7) / 8), 0);
        $bytes = (int)($size / 8);

        $p = 0;

        for ($i = 0; $i < $bytes; $i++) {
            $v = 0;
            for ($j = 0; $j < 8; $j++) {
                $v = $v << 1;
                $v |= $this->data[$p];
                $p++;
            }
            $data[$i] = $v;
        }

        if ($size & 7) {
            $v = 0;
            for ($j = 0; $j < ($size & 7); $j++) {
                $v = $v << 1;
                $v |= $this->data[$p];
                $p++;
            }
            $data[$bytes] = $v;
        }

        return $data;
    }

}