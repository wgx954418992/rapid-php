<?php


namespace apps\file\classier\model\oss\aliyun;

use rapidPHP\modules\core\classier\Model;

class CallbackModel extends Model
{
    /**
     * bucket
     * @var string|null
     */
    protected $bucket;

    /**
     * object
     * @var string|null
     */
    protected $object;

    /**
     * hash
     * @var string|null
     */
    protected $etag;

    /**
     * @var int|null
     */
    protected $size;

    /**
     * mime
     * @var string|null
     */
    protected $mimeType;

    /**
     * image width
     * @var int|null
     */
    protected $imageInfo_width;

    /**
     * image height
     * @var int|null
     */
    protected $imageInfo_height;

    /**
     * image format
     * @var string|null
     */
    protected $imageInfo_format;

    /**
     * @return string|null
     */
    public function getBucket(): ?string
    {
        return $this->bucket;
    }

    /**
     * @param string|null $bucket
     */
    public function setBucket(?string $bucket): void
    {
        $this->bucket = $bucket;
    }

    /**
     * @return string|null
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * @param string|null $object
     */
    public function setObject(?string $object): void
    {
        $this->object = $object;
    }

    /**
     * @return string|null
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }

    /**
     * @param string|null $etag
     */
    public function setEtag(?string $etag): void
    {
        $this->etag = $etag;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     */
    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string|null $mimeType
     */
    public function setMimeType(?string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return int|null
     */
    public function getImageInfoWidth(): ?int
    {
        return $this->imageInfo_width;
    }

    /**
     * @param int|null $imageInfo_width
     */
    public function setImageInfoWidth(?int $imageInfo_width): void
    {
        $this->imageInfo_width = $imageInfo_width;
    }

    /**
     * @return int|null
     */
    public function getImageInfoHeight(): ?int
    {
        return $this->imageInfo_height;
    }

    /**
     * @param int|null $imageInfo_height
     */
    public function setImageInfoHeight(?int $imageInfo_height): void
    {
        $this->imageInfo_height = $imageInfo_height;
    }

    /**
     * @return string|null
     */
    public function getImageInfoFormat(): ?string
    {
        return $this->imageInfo_format;
    }

    /**
     * @param string|null $imageInfo_format
     */
    public function setImageInfoFormat(?string $imageInfo_format): void
    {
        $this->imageInfo_format = $imageInfo_format;
    }
}
