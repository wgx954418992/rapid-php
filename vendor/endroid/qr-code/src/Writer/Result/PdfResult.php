<?php

declare(strict_types=1);

namespace Endroid\QrCode\Writer\Result;

final class PdfResult extends AbstractResult
{
    /** @var \FPDF */
    private $fpdf;

    public function __construct(\FPDF $fpdf)
    {
        $this->fpdf = $fpdf;
    }

    public function getString(): string
    {
        return $this->fpdf->Output('S');
    }

    public function getMimeType(): string
    {
        return 'application/pdf';
    }
}
