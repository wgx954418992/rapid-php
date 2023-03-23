<?php


namespace apps\file\classier\model\oss\baidu;

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
}
