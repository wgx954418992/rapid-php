<?php


namespace apps\oss\classier\service;


use oss\classier\model\UploadModel;
use OSS\Core\OssException;

abstract class IOssService
{

    /**
     * OSS RENAMES
     */
    const OSS_RENAMES = [];

    /**
     * oss process
     */
    const OSS_PROCESS = 'oss-process';

    /**
     * oss callback url
     */
    const OSS_CALLBACK = 'oss-callback';

    /**
     * oss callback var
     */
    const OSS_CALLBACK_VAR = 'oss-process-var';

    /**
     * 上传文件
     * @param UploadModel $uploadModel
     * @return null|string
     * @throws OssException
     */
    abstract public function uploadFile(UploadModel $uploadModel): ?string;

    /**
     * object是否存在
     * @param $object
     * @return bool
     */
    abstract public function existObject($object): bool;

    /**
     * 删除object
     * @param $object
     * @return bool
     */
    abstract public function delObject($object): bool;

    /**
     * 获取对象授权url
     * @param $object
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    abstract public function getObjectSignUrl($object, int $expires = 60, ?array $options = null): string;

    /**
     * 获取对象内容
     * @param $object
     * @param array|null $options
     * @return string
     */
    abstract public function getObject($object, ?array $options = null): string;

    /**
     * 处理options
     * @param $options
     */
    public function handlerOptions(&$options): void
    {
        if (empty($options)) return;

        foreach (static::OSS_RENAMES as $name => $newName) {
            if (isset($options[$name])) {
                $options[$newName] = $options[$name];

                unset($options[$name]);
            }
        }
    }
}
