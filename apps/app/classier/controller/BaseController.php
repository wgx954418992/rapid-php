<?php

namespace apps\app\classier\controller;

use apps\core\classier\controller\BaseController as CoreBaseController;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\AR;
use function rapidPHP\B;

class BaseController extends CoreBaseController
{

    /**
     * color
     * @param $color
     * @return Color|void|null
     * @throws Exception
     */
    private function toColorInterface($color): ?Color
    {
        $color = AR()->rename($color, ['r' => 'red', 'g' => 'green', 'b' => 'blue', 'a' => 'alpha']);

        return Utils::getInstance()->toObject(Color::class, $color);
    }

    /**
     * 二维码
     * @param $content
     * @param array|int $rect
     * @param array|null $logo
     * @param array $color
     * @param string $label
     * @param int[] $labelColor
     * @return string|void
     * @throws Exception
     */
    public function buildCode(
        $content,
        $rect = [300, 25],
        array $logo = null,
        array $color = [
            'f' => ['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0],
            'b' => ['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0],
        ],
        string $label = '',
        array $labelColor = ['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0])
    {

        if (empty($content)) return;

        $builder = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($content)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin());

        if (is_numeric($rect)) {
            $builder->size((int)$rect);
        } else if (is_array($rect)) {
            $size = (int)B()->getData($rect, 0);

            $builder->size($size);

            $margin = (int)B()->getData($rect, 1);

            $builder->margin($margin);
        }

        if (isset($color['f'])) {
            $builder->foregroundColor($this->toColorInterface($color['f']));
        }

        if (isset($color['b'])) {
            $builder->backgroundColor($this->toColorInterface($color['b']));
        }

        if (!empty($label)) {
            $builder->labelText($label)
                ->labelFont(new NotoSans(20))
                ->labelTextColor($this->toColorInterface($labelColor))
                ->labelAlignment(new LabelAlignmentCenter());
        }

        if (is_string($logo) && $logo) {
            $builder->logoPath($logo);
        } else if (is_array($logo)) {
            $path = (string)B()->getData($logo, 0);

            if (!empty($path)) $builder->logoPath($path);

            $logoSize = B()->getData($logo, 1);

            if (isset($logoSize[0]) && isset($logoSize[1])) {
                $builder->logoResizeToWidth($logoSize[0]);

                $builder->logoResizeToHeight($logoSize[1]);
            } else if (isset($logoSize[0])) {
                $builder->logoResizeToWidth($logoSize[0]);

                $builder->logoResizeToHeight($logoSize[1]);
            }
        }

        $result = $builder
            ->validateResult(false)
            ->build();

        $this->getResponse()->setHeader('Content-Type: ' . $result->getMimeType());

        return $result->getString();
    }
}
