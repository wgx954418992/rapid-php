<?php

namespace rapidPHP\plugin\qrcode;


use Exception;

class QRRawCode
{
    public $version;
    public $dataCode = array();
    public $eccCode = array();
    public $blocks;
    public $rsBlocks = array();
    public $count;
    public $dataLength;
    public $eccLength;
    public $b1;

    /**
     * QRRawCode constructor.
     * @param QRinput $input
     * @throws \Exception
     */
    public function __construct(QRinput $input)
    {
        $spec = array(0, 0, 0, 0, 0);

        $this->dataCode = $input->getByteStream();

        if (is_null($this->dataCode)) throw new Exception('null input string');

        QRSpec::getEccSpec($input->getVersion(), $input->getErrorCorrectionLevel(), $spec);

        $this->version = $input->getVersion();

        $this->b1 = QRSpec::rsBlockNum1($spec);

        $this->dataLength = QRSpec::rsDataLength($spec);

        $this->eccLength = QRSpec::rsEccLength($spec);

        $this->eccCode = array_fill(0, $this->eccLength, 0);

        $this->blocks = QRSpec::rsBlockNum($spec);

        $ret = $this->init($spec);

        if ($ret < 0) throw new Exception('block alloc error');

        $this->count = 0;
    }

    public function init(array $spec)
    {
        $dl = QRSpec::rsDataCodes1($spec);

        $el = QRSpec::rsEccCodes1($spec);

        $rs = QRrs::initRs(8, 0x11d, 0, 1, $el, 255 - $dl - $el);


        $blockNo = 0;
        $dataPos = 0;
        $eccPos = 0;
        for ($i = 0; $i < QRSpec::rsBlockNum1($spec); $i++) {
            $ecc = array_slice($this->eccCode, $eccPos);
            $this->rsBlocks[$blockNo] = new QRrsBlock($dl, array_slice($this->dataCode, $dataPos), $el, $ecc, $rs);
            $this->eccCode = array_merge(array_slice($this->eccCode, 0, $eccPos), $ecc);

            $dataPos += $dl;
            $eccPos += $el;
            $blockNo++;
        }

        if (QRSpec::rsBlockNum2($spec) == 0)
            return 0;

        $dl = QRSpec::rsDataCodes2($spec);
        $el = QRSpec::rsEccCodes2($spec);
        $rs = QRrs::initRs(8, 0x11d, 0, 1, $el, 255 - $dl - $el);

        if ($rs == NULL) return -1;

        for ($i = 0; $i < QRSpec::rsBlockNum2($spec); $i++) {
            $ecc = array_slice($this->eccCode, $eccPos);
            $this->rsBlocks[$blockNo] = new QRrsBlock($dl, array_slice($this->dataCode, $dataPos), $el, $ecc, $rs);
            $this->eccCode = array_merge(array_slice($this->eccCode, 0, $eccPos), $ecc);

            $dataPos += $dl;
            $eccPos += $el;
            $blockNo++;
        }

        return 0;
    }

    public function getCode()
    {
        if ($this->count < $this->dataLength) {
            $row = $this->count % $this->blocks;
            $col = $this->count / $this->blocks;
            if ($col >= $this->rsBlocks[0]->dataLength) {
                $row += $this->b1;
            }
            $ret = $this->rsBlocks[$row]->data[$col];
        } else if ($this->count < $this->dataLength + $this->eccLength) {
            $row = ($this->count - $this->dataLength) % $this->blocks;
            $col = ($this->count - $this->dataLength) / $this->blocks;
            $ret = $this->rsBlocks[$row]->ecc[$col];
        } else {
            return 0;
        }
        $this->count++;

        return $ret;
    }
}
