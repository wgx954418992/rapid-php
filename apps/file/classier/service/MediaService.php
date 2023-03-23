<?php


namespace apps\file\classier\service;

use apps\core\classier\model\AppFileModel;
use Exception;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Media\Video;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;
use function rapidPHP\DI;
use function rapidPHP\V;

class MediaService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * @var FFMpeg
     */
    private $ffmpeg;


    /**
     * @var FFProbe
     */
    private $ffprobe;

    /**
     * @var string
     */
    private $cwebp;

    /**
     * @var string
     */
    private $dwebp;

    /**
     * FFmpegService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->cwebp = $this->exec("which cwebp || type -p cwebp || type -p /usr/local/bin/cwebp");

        if (!is_file($this->cwebp)) throw new Exception('cweb path not found');

        $this->dwebp = $this->exec("which dwebp || type -p dwebp || type -p /usr/local/bin/dwebp");

        if (!is_file($this->dwebp)) throw new Exception('dwebp path not found');

        $params = [
            'ffmpeg.binaries' => $this->exec("which ffmpeg || type -p ffmpeg || type -p /usr/local/bin/ffmpeg"),
            'ffprobe.binaries' => $this->exec("which ffprobe || type -p ffprobe || type -p /usr/local/bin/ffprobe"),
        ];

        $this->ffmpeg = FFMpeg::create($params);

        $this->ffprobe = FFProbe::create($params);
    }

    /**
     * 执行命令
     * @param $cmd
     * @return string
     */
    private function exec($cmd)
    {
        exec($cmd, $result);

        return (string)B()->getData($result, 0);
    }

    /**
     * 保存网络文件
     * @param string $url
     * @return string
     * @throws Exception
     */
    private function saveNetworkFile(string $url): string
    {
        if (!V()->website($url)) throw new Exception('url 错误!');

        $savePath = PATH_APP_RUNTIME . 'tmp/media/load/' . md5($url);

        if (!is_dir(dirname($savePath)) && !mkdir(dirname($savePath), 0777, true)) throw new Exception('创建目录失败!');

        $loadBody = @file_get_contents($url);

        if (empty($loadBody)) throw new Exception('载入网络图片错误!');

        if (file_put_contents($savePath, $loadBody) === false) {
            unset($loadBody);

            throw new Exception('保存网络图片失败!');
        }

        unset($loadBody);

        return $savePath;
    }

    /**
     * 转 webp
     * @param $filepath
     * @param int $quality
     * @param int $ratio
     * @return bool|string
     * @throws Exception
     */
    public function toWebp($filepath, int $quality = 75, int $ratio = 4)
    {
        if (!is_file($filepath) && !V()->website($filepath)) throw new Exception('filepath 错误!');

        if (is_file($filepath)) {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/webp/' . md5_file($filepath);
        } else {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/webp/' . md5($filepath);
        }

        if (!is_dir(dirname($savePath)) && !mkdir(dirname($savePath), 0777, true)) throw new Exception('创建目录失败!');

        if (V()->website($filepath)) {
            $filepath = $loadPath = $this->saveNetworkFile($filepath);
        }

        $command = "{$this->cwebp} -q {$quality} -m {$ratio} '{$filepath}' -o '{$savePath}' 2>&1";

        $this->exec($command);

        if (isset($loadPath) && is_file($loadPath)) unlink($loadPath);

        if (is_file($savePath)) return $savePath;

        return false;
    }

    /**
     * webp 转 png
     * @param $filepath
     * @return bool|string
     * @throws Exception
     */
    public function dwebp($filepath)
    {
        if (!is_file($filepath) && !V()->website($filepath)) throw new Exception('filepath 错误!');

        if (is_file($filepath)) {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/dwebp/' . md5_file($filepath);
        } else {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/dwebp/' . md5($filepath);
        }

        if (!is_dir(dirname($savePath)) && !mkdir(dirname($savePath), 0777, true)) throw new Exception('创建目录失败!');

        if (V()->website($filepath)) {
            $filepath = $loadPath = $this->saveNetworkFile($filepath);
        }

        $command = "{$this->dwebp} {$filepath} -o {$savePath} 2>&1";

        $this->exec($command);

        if (isset($loadPath) && is_file($loadPath)) unlink($loadPath);

        if (is_file($savePath)) return $savePath;

        return false;
    }

    /**
     * 获取视频或者图片的属性 高宽，时长
     * @param $filePath
     * @param null $name
     * @return FFProbe\DataMapping\Stream|float|string|null
     */
    public function getProperty($filePath, $name = null)
    {
        try {
            $video = $this->ffprobe->streams($filePath)
                ->videos()
                ->first();

            if ($video == null) throw new Exception('video error');

            if (empty($name)) return $video;

            return $video->get($name);

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * 获取视音频时长->秒
     * @param $filePath
     * @return float|null
     * @throws Exception
     */
    public function getDuration($filePath): ?float
    {
        return $this->getProperty($filePath, 'duration');
    }

    /**
     * 获取视频封面
     * @param $filepath
     * @param int $fromSeconds
     * @param bool $isWebp
     * @return bool|string
     * @throws Exception
     */
    public function getCover($filepath, int $fromSeconds = 0, bool $isWebp = true)
    {
        if (!is_file($filepath) && !V()->website($filepath)) throw new Exception('filepath 错误!');

        if (is_file($filepath)) {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/cover/' . md5_file($filepath);
        } else {
            $savePath = PATH_APP_RUNTIME . 'tmp/media/cover/' . md5($filepath);
        }

        if (!is_dir(dirname($savePath)) && !mkdir(dirname($savePath), 0777, true)) throw new Exception('创建目录失败!');

        try {
            $video = $this->ffmpeg->open($filepath);

            if ($video instanceof Video) {
                $video->filters()->synchronize();

                $video->frame(TimeCode::fromSeconds($fromSeconds))
                    ->save($savePath);

                if (!is_file($savePath)) return false;

                if (!$isWebp) return $savePath;

                $webpPath = $this->toWebp($savePath);

                unlink($savePath);

                if (!is_file($webpPath)) return false;

                return $webpPath;
            }

        } catch (Exception $e) {

        }

        return false;
    }

    /**
     * 获取视频封面 FileModel
     * @param $filepath
     * @param int $fromSeconds
     * @param null $actionId
     * @return AppFileModel|null
     * @throws Exception
     */
    public function getCoverFileModel($filepath, int $fromSeconds = 0, $actionId = null)
    {
        $tmpFilepath = $this->getCover($filepath, $fromSeconds, true);

        if (!$tmpFilepath) throw new Exception('生成封面失败！');

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = new AppFileModel();

        $fileModel->setPath($tmpFilepath);

        $fileModel->setMd5(md5_file($tmpFilepath));

        $fileModel->setName(basename($tmpFilepath));

        $fileModel->setCreatedId($actionId);

        $fileModel->setUpdatedId($actionId);

        return $fileManagerService->upload($fileModel);
    }
}
