<?php


namespace apps\file\classier\model;


use Exception;
use finfo;
use rapidPHP\modules\core\classier\Model;

class PHPFileModel extends Model
{

    /**
     * error code
     */
    const ERROR_CODE = [
        1 => '上传文件太大了!',
        2 => '上传文件太大了(MAX_FILE_SIZE)!',
        3 => '文件只有部分被上传!',
        4 => '没有文件被上传!',
        6 => '找不到临时文件夹!',
        7 => '文件写入失败!',
    ];

    /**
     * 错误信息
     * @var string|null
     */
    private $error;

    /**
     * path
     * @var string|null
     */
    private $tmp_name;

    /**
     * 文件名
     * @var string|null
     */
    private $name;

    /**
     * 文件大小
     * @var string|null
     */
    private $size;

    /**
     * mime
     * @var string|null
     */
    private $mime;

    /**
     * hash
     * @var string[]
     */
    private $hash = [];

    /**
     * 是否有效
     * @return bool
     */
    public function isValid(): bool
    {
        if (empty($this->tmp_name) || !is_file($this->tmp_name)) return false;

        return true;
    }

    /**
     * 获取文件的hash
     * @param string $type
     * @return false|string
     */
    public function getHash(string $type = 'MD5')
    {
        $type = strtoupper($type);

        if (isset($this->hash[$type])) return $this->hash[$type];

        switch ($type) {
            case 'MD5':
                $result = md5_file($this->tmp_name);
                break;
            default:
                return false;
        }

        $this->hash[$type] = $result;

        return $result;
    }

    /**
     * error text
     * @throws Exception
     */
    public function getErrorInfo(): ?string
    {
        if (!isset(self::ERROR_CODE[$this->error])) return null;

        return self::ERROR_CODE[$this->error];
    }

    /**
     * 获取文件mime
     * @return string
     */
    public function getFileMime(): string
    {
        if ($this->mime) return $this->mime;

        $fi = new finfo();

        return $this->mime = $fi->file($this->tmp_name, FILEINFO_MIME_TYPE);
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string|null $error
     */
    public function setError(?string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return string|null
     */
    public function getTmpName(): ?string
    {
        return $this->tmp_name;
    }

    /**
     * @param string|null $tmp_name
     */
    public function setTmpName(?string $tmp_name): void
    {
        $this->tmp_name = $tmp_name;

        $this->mime = null;

        $this->hash = [];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     */
    public function setSize(?string $size): void
    {
        $this->size = $size;
    }

}
