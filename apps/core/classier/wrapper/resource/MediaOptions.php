<?php


namespace apps\core\classier\wrapper\resource;

class MediaOptions
{

    /**
     * 宽度
     * @var float|null
     */
    private $width;

    /**
     * 高度
     * @var float|null
     */
    private $height;

    /**
     * @return float|null
     */
    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * @param float|null $width
     */
    public function setWidth(?float $width): void
    {
        $this->width = $width;
    }

    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * @param float|null $height
     */
    public function setHeight(?float $height): void
    {
        $this->height = $height;
    }
}