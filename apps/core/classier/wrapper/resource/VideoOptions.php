<?php


namespace apps\core\classier\wrapper\resource;

class VideoOptions extends MediaOptions
{

    /**
     * 封面文件id
     * @var string|int|null
     */
    private $cover_fid;

    /**
     * 总时长
     * @var int|null
     */
    private $duration;

    /**
     * @var string
     */
    private $cover_url;

    /**
     * @return int|string|null
     */
    public function getCoverFid()
    {
        return $this->cover_fid;
    }

    /**
     * @param int|string|null $cover_fid
     */
    public function setCoverFid($cover_fid): void
    {
        $this->cover_fid = $cover_fid;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     */
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getCoverUrl(): string
    {
        return $this->cover_url;
    }

    /**
     * @param string $cover_url
     */
    public function setCoverUrl(string $cover_url): void
    {
        $this->cover_url = $cover_url;
    }

}