<?php

namespace rapidPHP\modules\excel\classier;

use Generator;
use PhpOffice\PhpSpreadsheet\Exception as SpreadException;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\excel\config\Head;

class Sheet
{
    /**
     * @var Worksheet
     */
    private $sheet;

    /**
     * Sheet constructor.
     * @param Worksheet $sheet
     */
    public function __construct(Worksheet $sheet)
    {
        $this->setSheet($sheet);
    }

    /**
     * @return Worksheet
     */
    public function getSheet(): Worksheet
    {
        return $this->sheet;
    }

    /**
     * @param Worksheet $sheet
     */
    public function setSheet(Worksheet $sheet): void
    {
        $this->sheet = $sheet;
    }

    /**
     * 写入head
     * @param $heads
     * ['field'=>'字段名']
     * or
     * ['field'=>
     *  [
     *      'name'=>'字段名',
     *      'width'=>100,
     *      'vertical'=>Alignment::VERTICAL_CENTER,
     *      'horizontal'=>Alignment::HORIZONTAL_CENTER,
     *      'wrap_text'=>true
     *  ]
     * ]
     * @param string $horizontalIndex 水平开始索引，默认为A,(B,C,D)....
     * @param int $verticalIndex 垂直开始索引，默认为1,(2,3,4)....
     */
    public function putHead($heads, string $horizontalIndex = 'A', int $verticalIndex = 1)
    {
        foreach ($heads as $key => $head) {

            $this->sheet->setCellValue($horizontalIndex . $verticalIndex, Head::getName($head));;

            if (($width = Head::getWidth($head)) != false) {
                $this->sheet->getColumnDimension($horizontalIndex)->setWidth($width);
            }

            $this->sheet->getStyle($horizontalIndex . $verticalIndex)
                ->getAlignment()
                ->setHorizontal(Head::getAlignHorizontal($head))
                ->setVertical(Head::getAlignVertical($head))
                ->setWrapText(Head::getWrapText($head));

            $horizontalIndex++;
        }
    }

    /**
     * 写入list
     * @param $list
     * list可以不按照heads的顺序排列，最终写入结果是按照heads顺序来写的
     * ['field'=>'value']
     * @param $heads
     * ['field'=>'字段名']
     * or
     * ['field'=>
     *  [
     *      'name'=>'字段名',
     *      'width'=>100,
     *      'vertical'=>Alignment::VERTICAL_CENTER,
     *      'horizontal'=>Alignment::HORIZONTAL_CENTER,
     *      'wrap_text'=>true
     *  ]
     * ]
     * @param string $horizontalIndex 水平开始索引，默认为A,(B,C,D)....
     * @param int $verticalIndex 垂直开始索引，默认为2，因为head默认是从1开始的，所以list要下一行
     */
    public function putList($list, $heads, string $horizontalIndex = 'A', int $verticalIndex = 2)
    {
        foreach ($list as $item) {

            $horizontalStartIndex = $horizontalIndex;

            foreach ($heads as $filed => $head) {
                $value = Build::getInstance()->getData((array)$item, $filed);

                if (is_null($value)) $value = "";

                if (is_array($value)) {
                    $value = array_filter($value, [$this, 'filterArrayEmpty']);

                    $value = join("\n", $value);
                }

                $this->sheet->getStyle($horizontalStartIndex . $verticalIndex)
                    ->getAlignment()
                    ->setHorizontal(Head::getAlignHorizontal($head))
                    ->setVertical(Head::getAlignVertical($head))
                    ->setWrapText(Head::getWrapText($head));

                $this->sheet->setCellValueExplicit($horizontalStartIndex . $verticalIndex,
                    $value,
                    DataType::TYPE_STRING);

                $horizontalStartIndex++;
            }

            $verticalIndex++;
        }
    }

    /**
     * 过滤空数组
     * @param $v
     * @return bool
     */
    private function filterArrayEmpty($v): bool
    {
        return !empty($v);
    }

    /**
     * 读取excel数据
     * @param $fields
     * 字段 ['field1','field2'...] 规定了哪些字段就读取哪些字段
     * @param string $horizontalIndex 水平开始索引，默认为A,(B,C,D)....
     * @param int $verticalIndex 垂直开始索引，默认为2，因为一般第一行都是head说明
     * @return Generator
     * @throws SpreadException
     */
    public function read($fields, string $horizontalIndex = 'A', int $verticalIndex = 2): Generator
    {
        $highestRow = $this->sheet->getHighestRow();

        for (; $verticalIndex <= $highestRow; $verticalIndex++) {
            $data = [];

            $horizontalStartIndex = $horizontalIndex;

            foreach ($fields as $field) {
                $data[$field] = $this->sheet
                    ->getCell($horizontalStartIndex . $verticalIndex)
                    ->getValue();

                $horizontalStartIndex++;
            }

            yield $data;
        }
    }
}
