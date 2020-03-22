<?php

namespace rapidPHP\plugin\qrcode;

class QRrsBlock
{
    public $dataLength;
    public $data = array();
    public $eccLength;
    public $ecc = array();

    public function __construct($dl, $data, $el, &$ecc, QRRsItem $rs)
    {
        $rs->encode_rs_char($data, $ecc);

        $this->dataLength = $dl;

        $this->data = $data;

        $this->eccLength = $el;

        $this->ecc = $ecc;
    }
}