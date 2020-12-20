<?php

namespace rapidPHP\modules\excel\classier;

use PhpOffice\PhpSpreadsheet\Exception as SpreadException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use rapidPHP\modules\common\classier\Instances;

class Excel
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 从文件载入spreadSheet
     * @param $filename
     * @return Spreadsheet
     * @throws ReaderException
     */
    public function loadSpreadSheet($filename): Spreadsheet
    {
        $inputFileType = IOFactory::identify($filename);

        $reader = IOFactory::createReader($inputFileType);

        $reader->setReadDataOnly(true);

        $reader->setLoadSheetsOnly($filename);

        return $reader->load($filename);
    }

    /**
     * 获取当前活动的sheet
     * @param Spreadsheet $spreadsheet
     * @param int $index
     * @return Sheet
     * @throws SpreadException
     */
    public function getSheet(Spreadsheet $spreadsheet, $index = 0): Sheet
    {
        $spreadsheet->setActiveSheetIndex($index);

        $sheet = $spreadsheet->getActiveSheet();

        return new Sheet($sheet);
    }

    /**
     * 保存
     * @param Spreadsheet $spreadsheet
     * @param $filename
     * @throws WriterException
     */
    public function save(Spreadsheet $spreadsheet, $filename)
    {
        $writer = new Xlsx($spreadsheet);

        $writer->save($filename);
    }
}