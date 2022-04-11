<?php

namespace apps\core\classier\service\ocr;


use AipOcr;
use apps\core\classier\config\ocr\BaiduConfig;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\AB;

class BaiduService
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
     * @var AipOcr
     */
    protected $aipOcr;

    /**
     * OCRService
     */
    public function __construct()
    {
        $config = BaiduConfig::getInstance();

        $this->aipOcr = new AipOcr(
            $config->getAppId(),
            $config->getAppKey(),
            $config->getSecret(),
        );
    }

    /**
     * 图片识别
     * @param $file
     * @param string|null $method
     * @return array
     * @throws Exception
     */
    public function getOcrResult($file, ?string $method = null)
    {
        if (empty($method)) $method = 'basicGeneral';

        $fileContents = file_get_contents($file);

        if (!method_exists($this->aipOcr, $method)) throw new Exception('方法错误!');

        $response = call_user_func_array([$this->aipOcr, $method], [$fileContents]);

        $data = AB($response);

        if ($data->hasName('error_code')) throw new Exception($data->toString('error_msg'));

        $result = $data->toArray('words_result');

        if (empty($result)) throw new Exception('没有识别出图片文字哦(查看图片是否存在文字)!');

        return $result;
    }
}
