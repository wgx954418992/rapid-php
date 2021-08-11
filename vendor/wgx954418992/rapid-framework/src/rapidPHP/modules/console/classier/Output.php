<?php

namespace rapidPHP\modules\console\classier;


use rapidPHP\modules\io\classier\Output as IOOutput;
use function rapidPHP\B;

class Output implements IOOutput
{

    /**
     * 输出数据
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    public function write(?string $data, array $options = []): bool
    {
        $foregroundColor = B()->getData($options, 0);

        $backgroundColor = B()->getData($options, 1);

        echo Utils::getInstance()->getColoredString($data, $foregroundColor, $backgroundColor) . "\n";

        return true;
    }

    /**
     * 打印输出
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    public function printf(?string $data, array $options = []): bool
    {
        return $this->write($data, $options);
    }

    /**
     * 打印输出=》成功的样式
     * @param string|null $data
     * @return bool
     */
    public function psuccess(?string $data): bool
    {
        return $this->write($data, [
            Utils::FOREGROUND_COLOR_LIGHT_GREEN,
        ]);
    }


    /**
     * 打印输出=》错误失败的样式
     * @param string|null $data
     * @return bool
     */
    public function perror(?string $data): bool
    {
        return $this->write($data, [
            Utils::FOREGROUND_COLOR_YELLOW,
            Utils::BACKGROUND_COLOR_RED,
        ]);
    }
}
