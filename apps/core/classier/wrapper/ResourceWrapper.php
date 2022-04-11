<?php


namespace apps\core\classier\wrapper;

use apps\core\classier\model\AppResourceModel;
use apps\core\classier\wrapper\resource\ImageOptions;
use apps\core\classier\wrapper\resource\VideoOptions;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\B;

class ResourceWrapper extends AppResourceModel
{

    /**
     * @var string
     */
    private $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * 把当前options抓换成image options
     * @return object|void|null
     * @throws Exception
     */
    public function optionsToImageOptions()
    {
        $options = $this->getOptions();

        if($options instanceof ImageOptions) return $options;

        if(is_string($options)) $options = B()->jsonDecode($options);

        $options = Utils::getInstance()->toObject(ImageOptions::class, $options);

        $this->setOptions($options);

        return $options;
    }

    /**
     * 把当前options抓换成video options
     * @return object|void|null
     * @throws Exception
     */
    public function optionsToVideoOptions()
    {
        $options = $this->getOptions();

        if($options instanceof VideoOptions) return $options;

        if(is_string($options)) $options = B()->jsonDecode($options);

        $options = Utils::getInstance()->toObject(VideoOptions::class, $options);

        $this->setOptions($options);

        return $options;
    }
}