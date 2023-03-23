<?php

namespace rapidPHP\modules\core\classier\web;

use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Path;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\core\classier\web\template\TemplateService;

class ViewTemplate
{
    /**
     * @var WebController
     */
    protected $controller;

    /**
     * @var string 文件名
     */
    protected $filename;

    /**
     * @var AB 变量集合
     */
    protected $data;

    /**
     * @var TemplateService
     */
    protected $templateService;

    /**
     * ViewTemplate constructor.
     * @param WebController $controller
     * @param $fileName
     * @param TemplateService|null $templateService
     */
    public function __construct(WebController $controller, $fileName, ?TemplateService $templateService = null)
    {
        $this->data = new AB();

        $this->controller = $controller;

        $this->filename = $fileName;

        if (is_null($templateService)) {
            $this->templateService = Application::getInstance()
                ->getConfigWrapper()
                ->getApplication()
                ->getWeb()
                ->getView()
                ->getTemplateService();
        } else {
            $this->templateService = $templateService;
        }
    }

    /**
     * 获取controller
     * @return WebController|Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return self
     */
    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return TemplateService
     */
    public function getTemplateService(): TemplateService
    {
        return $this->templateService;
    }

    /**
     * @param AB $data
     * @return $this
     */
    public function setData(AB $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 设置变量
     * @param $key :key或者数据
     * @param mixed $value :值
     * @return $this
     * @throws Exception
     */
    public function assign($key, $value = '')
    {
        if (is_array($key)) {
            $this->data->data($key);
        } else if ($key instanceof AB) {
            $this->data->data($key->toData());
        } else if ($key instanceof Model) {
            $this->data->value('data', $key);
        } else {
            $this->data->value($key, $value);
        }

        return $this;
    }

    /**
     * 引入模板
     * @code <?= VT($this)->includes(dirname(__DIR__).'/includes/header.php') ?>
     *       `不支持，会导致从缓存目录引入'/includes/header.php'`
     * @code <?= VT($this)->includes('../includes/header.php') ?>
     *       `支持`
     * @desc 该方法模版直接变量不会隔离，采用的是正则解析 VT($this)->includes 出来引入的文件路径，
     *       然后统一编译，统一缓存 并且不能同时使用use，并且传入的路径不能包含php方法
     * @since 8.1
     * @param $file
     */
    public function includes($file)
    {

    }

    /**
     * 引入模板
     * @code <?= VT($this)->includeView(dirname(__DIR__).'/includes/header.php') ?>
     *       `支持`
     * @code <?= VT($this)->includeView('../includes/header.php') ?>
     *       `支持`
     * @desc 该方法会实现模版跟模版之间变量隔离，使用use也不会影响，不过这种方式会同时编译主文件跟includeView的文件
     * @param $file
     */
    public function includeView($file)
    {
        $view = clone $this;

        $templateFile = str_replace($this->getTemplateService()->getCachePath(),'',$file);

        $view->setFilename($templateFile);

        return $view->view();
    }

    /**
     * 预处理引入模板
     * @param $strings
     * @return mixed
     */
    private function preIncludes($strings, $filepath)
    {
        preg_match_all("/<\?.*?->includes\(['|\"](.*)['|\"]\).*?\?>/i", $strings, $data);

        $patterns = Build::getInstance()->getData($data, 0);

        $includes = Build::getInstance()->getData($data, 1);

        if (!$patterns && !$includes) {
            return $strings;
        } else {

            $rule = [];

            foreach ($includes as $index => $include) {
                $pathDir = $this->getCompileLinkPathDir(dirname($filepath), $include);

                $templateFilepath = $this->getTemplateService()->findTemplateFile($pathDir);

                $content = File::getInstance()->getContent($templateFilepath);

                $content = $this->compile($content, $templateFilepath);

                $pattern = Build::getInstance()->getData($patterns, $index);

                $rule["#" . preg_quote($pattern) . "#i"] = $content;
            }

            $strings = preg_replace(array_keys($rule), $rule, $strings);

            return $this->preIncludes($strings, $filepath);
        }
    }

    /**
     * 编译
     * @param $strings
     * @param $filepath
     * @return array|string|string[]|null
     */
    private function compile($strings, $filepath)
    {
        $linkRule = $this->getCompileLinkRule($strings, $filepath);

        return preg_replace(array_keys($linkRule), $linkRule, $strings);
    }

    /**
     * 获取编译链接 path 目录
     * @param $filedir
     * @param $value
     * @return mixed
     */
    private function getCompileLinkPathDir($filedir, $value): string
    {
        $result = (array)Build::getInstance()->getRegularAll("#(\.\./|\./)#i", $value);

        if (count($result) === 0) {
            $pathDir = "{$filedir}/{$value}";
        } else {
            $path = count($result) === 1 && $result[0] === './' ? "{$filedir}/" : Path::getInstance()->dirName($filedir, count($result));

            $pathDir = str_replace(join('', $result), $path, $value);
        }

        return str_replace([PATH_PUBLIC, PATH_APP, PATH_ROOT], '/', $pathDir);
    }


    /**
     * 获取编译链接规则
     * @param $strings
     * @param $filepath
     * @return mixed
     */
    private function getCompileLinkRule($strings, $filepath): array
    {
        $list = [];

        preg_match_all("/([\"'])(\.\.\/.*?)([\"'])/i", $strings, $dirList);

        if ($dirList && isset($dirList[0]) && isset($dirList[3]) && count($dirList[0]) == count($dirList[2])) {

            foreach ($dirList[2] as $item => $value) {

                if ($value) $list[$dirList[0][$item]] = $value;
            }
        }

        preg_match_all("#(src|href|action)=([\"'])((?!(\s|<\?=|<\?php|{.*}|https|data:image|http|ftp|rtsp|mms|//|\#|\.\./|\./|javascript:)).*?)([\"'])#", $strings, $linkList);

        if ($linkList && isset($linkList[0]) && isset($linkList[3]) && count($linkList[0]) == count($linkList[3])) {

            foreach ($linkList[3] as $item => $value) {

                if ($value) $list[$linkList[0][$item]] = $value;
            }
        }

        $rule = [];

        $appRootUrl = rtrim($this->getController()->getHostUrl(), '/*');

        foreach ($list as $item => $value) {

            $pathDir = $this->getCompileLinkPathDir(dirname($filepath), $value);

            $link = str_replace($value, "{$appRootUrl}{$pathDir}", $item);

            $rule["#" . preg_quote($item) . "#i"] = $link;
        }

        return $rule;
    }

    /**
     * @param $compileResult
     * @return string
     */
    private function putHeader($compileResult): string
    {
        return "<?php /** cache Time " . Calendar::getInstance()->getDate() . " */ defined('PATH_APP') or die();?>\n{$compileResult}";
    }

    /**
     * @param $name
     * @return array|null|AB|string
     */
    public function get($name = null)
    {
        return is_null($name) ? $this->data : $this->data->toValue($name);
    }

    /**
     * 获取include文件内容
     * @param $fileName
     * @return false|string
     */
    private function getIncludeContents($fileName)
    {
        ob_start();

        include $fileName . '';

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

    /**
     * @param $cacheFile
     * @param $outputType
     * @return false|string|void
     */
    public function getOutputContent($cacheFile, $outputType)
    {
        switch ($outputType) {
            case TemplateService::OUTPUT_TYPE_FILE:
                return $this->getIncludeContents($cacheFile);
            case TemplateService::OUTPUT_TYPE_CONTENT:
                return $cacheFile;
        }
    }


    /**
     * 显示
     * @return false|string|null
     * @throws Exception
     */
    public function view()
    {
        $filepath = $this->getTemplateService()->findTemplateFile($this->filename);

        if (!is_file($filepath)) throw new Exception($this->filename . ' view error!');

        $cacheFile = $this->getTemplateService()->getCache($this->filename, $outputType);

        if ($cacheFile !== false) {
            return $this->getOutputContent($cacheFile, $outputType);
        }

        $string = $this->preIncludes(File::getInstance()->getContent($filepath), $filepath);

        $string = $this->compile($string, $filepath);

        $string = $this->putHeader($string);

        $cacheFile = $this->getTemplateService()->addCache($this->filename, $string, $outputType);

        if ($cacheFile === false) throw new Exception('cache error!');

        return $this->getOutputContent($cacheFile, $outputType);
    }

    /**
     * 获取网站根url
     * @return string
     */
    public function getHostUrl(): string
    {
        return $this->getController()->getHostUrl();
    }

    /**
     * 通过参数生成url
     * @param bool $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl(bool $meter = false, bool $isDecode = true): string
    {
        return $this->getController()->getUrl($meter, $isDecode);
    }

    /**
     * 通过参数生成url
     * @return string
     */
    public function toUrl(): string
    {
        return call_user_func_array([$this->getController()->getRequest(), 'toUrl'], func_get_args());
    }

    /**
     * 翻译
     * @param $word
     * @param array $arg
     * @param string $lang
     * @return string|string[]
     */
    public function t($word, array $arg = [], string $lang = '')
    {
        return $this->getController()->t($word, $arg, $lang);
    }
}
