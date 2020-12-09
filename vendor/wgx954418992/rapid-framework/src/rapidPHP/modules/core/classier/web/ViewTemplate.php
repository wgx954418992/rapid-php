<?php

namespace rapidPHP\modules\core\classier\web;

use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Path;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\core\classier\web\template\TemplateService;

class ViewTemplate
{
    /**
     * @var WebController
     */
    private $controller;

    /**
     * @var string 文件名
     */
    private $filename;

    /**
     * @var AB 变量集合
     */
    private $data;

    /**
     * @var TemplateService
     */
    private $templateService;

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

        if (empty($config)) {
            $this->templateService = Application::getInstance()
                ->getConfig()
                ->getApplication()
                ->getWeb()
                ->getView()
                ->getTemplateService();
        } else {
            $this->templateService = $templateService;
        }
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
     * @param string $value 值
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
            $this->data->data($key->toData());
        } else {
            $this->data->value($key, $value);
        }

        return $this;
    }

    /**
     * 引入模板
     * @param $file
     */
    public function includes($file)
    {
    }

    /**
     * 生成预处理引入模板替换规则
     * @param $patterns
     * @param $includes
     * @return array
     */
    private function getPreIncludesPregReplaceRule($patterns, $includes)
    {
        $rule = [];

        foreach ($includes as $index => $include) {
            $filepath = $this->getTemplateService()->findTemplateFile($include);

            $strings = File::getInstance()->getContent($filepath);

            $strings = $this->compile($strings, $filepath);

            $pattern = Build::getInstance()->getData($patterns, $index);

            $rule["#" . preg_quote($pattern) . "#i"] = $strings;
        }
        return $rule;
    }

    /**
     * 预处理引入模板
     * @param $strings
     * @return mixed
     */
    private function preIncludes($strings)
    {
        preg_match_all("/<\?.*?->includes\(['|\"](.*)['|\"]\).*?\?>/i", $strings, $data);

        $patterns = Build::getInstance()->getData($data, 0);

        $includes = Build::getInstance()->getData($data, 1);

        if (!$patterns && !$includes) {
            return $strings;
        } else {

            $rule = $this->getPreIncludesPregReplaceRule($patterns, $includes);

            $strings = preg_replace(array_keys($rule), $rule, $strings);

            return $this->preIncludes($strings);
        }
    }

    /**
     * 编译
     * @param $strings
     * @param $filepath
     * @return mixed
     */
    private function compile($strings, $filepath)
    {
        $likeRule = $this->getCompileLikeRule($strings, $filepath);

        return preg_replace(array_keys($likeRule), $likeRule, $strings);
    }

    /**
     * 获取编译链接列表 A
     * @param $strings
     * @return array
     */
    private function getCompileLikeListA($strings)
    {
        $list = [];

        preg_match_all("/([\"'])(\.\.\/.*?)([\"'])/i", $strings, $dirList);

        if ($dirList && isset($dirList[0]) && isset($dirList[3]) && count($dirList[0]) == count($dirList[2])) {

            foreach ($dirList[2] as $item => $value) {

                if ($value) $list[$dirList[0][$item]] = $value;
            }
        }

        return $list;
    }

    /**
     * 获取编译链接列表 B
     * @param $strings
     * @return array
     */
    private function getCompileLikeListB($strings)
    {
        $list = [];

        preg_match_all("#(src|href|action)=([\"'])((?!(\s|<\?=|<\?php|{.*}|https|data:image|http|ftp|rtsp|mms|//|\#|\.\./|\./|javascript:)).*?)([\"'])#", $strings, $likeList);

        if ($likeList && isset($likeList[0]) && isset($likeList[3]) && count($likeList[0]) == count($likeList[3])) {

            foreach ($likeList[3] as $item => $value) {

                if ($value) $list[$likeList[0][$item]] = $value;
            }
        }

        return $list;
    }

    /**
     * 获取编译链接列表
     * @param $strings
     * @return array
     */
    private function getCompileLikeList($strings)
    {
        $listA = $this->getCompileLikeListA($strings);

        $listB = $this->getCompileLikeListB($strings);

        return array_merge($listA, $listB);
    }

    /**
     * 获取编译链接 path 目录
     * @param $dir
     * @param $value
     * @return mixed
     */
    private function getCompileLikePathDir($dir, $value)
    {
        $result = (array)Build::getInstance()->getRegularAll("#(\.\./|\./)#i", $value);

        if (count($result) === 0) {
            $pathDir = "$dir/$value";
        } else {
            $path = count($result) === 1 && $result[0] === './' ? "$dir/" : Path::getInstance()->dirName($dir, count($result));

            $pathDir = str_replace(join('', $result), $path, $value);
        }
        return $pathDir;
    }

    /**
     * 获取编译链接规则列表
     * @param $list
     * @param $filepath
     * @return mixed
     */
    private function getCompileLikeRuleList($list, $filepath)
    {
        $rule = [];

        $dir = str_replace([PATH_APP, PATH_ROOT], '/', dirname($filepath));

        $appRootUrl = rtrim($this->controller->getHostUrl(), '/*');

        foreach ($list as $item => $value) {

            $pathDir = $this->getCompileLikePathDir($dir, $value);

            $link = str_replace($value, "{$appRootUrl}{$pathDir}", $item);

            $rule["#" . preg_quote($item) . "#i"] = $link;
        }
        return $rule;
    }

    /**
     * 获取编译链接规则
     * @param $strings
     * @param $filepath
     * @return mixed
     */
    private function getCompileLikeRule($strings, $filepath)
    {
        $likeList = $this->getCompileLikeList($strings);

        return $this->getCompileLikeRuleList($likeList, $filepath);
    }


    /**
     * @param $compileResult
     * @return string
     */
    private function putHeader($compileResult)
    {
        return "<?php /** cache Time " . Calendar::getInstance()->getDate() . " */ defined('PATH_APP') or die();?>\n{$compileResult}";
    }

    /**
     * @param null $name
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
                break;
            case TemplateService::OUTPUT_TYPE_CONTENT:
                return $cacheFile;
                break;
        }
        return;
    }


    /**
     * 显示
     * @return false|string|null
     * @throws Exception
     */
    public function view()
    {
        $filepath = $this->getTemplateService()->findTemplateFile($this->filename);

        if (!is_file($filepath)) throw new Exception('view error!');
        
        $cacheFile = $this->getTemplateService()->getCache($this->filename, $outputType);

        if ($cacheFile !== false) {
            return $this->getOutputContent($cacheFile, $outputType);
        }

        $string = $this->preIncludes(File::getInstance()->getContent($filepath));

        $string = $this->compile($string, $filepath);

        $string = $this->putHeader($string);

        $cacheFile = $this->getTemplateService()->addCache($this->filename, $string, $outputType);

        if ($cacheFile === false) throw new Exception('cache error!');

        return $this->getOutputContent($cacheFile, $outputType);
    }

    /**
     * 如果调用的方法不存在，就去controller里面找
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public function __call($name, $arguments)
    {
        if (is_callable([$this->controller, $name])) {
            return call_user_func_array([$this->controller, $name], $arguments);
        }

        return null;
    }

    /**
     * 获取controller
     * @return WebController
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * 获取网站根url
     * @return string
     */
    public function getHostUrl(): string
    {
        return $this->controller->getHostUrl();
    }

    /**
     * 通过参数生成url
     * @param bool $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl($meter = false, $isDecode = true): string
    {
        return $this->controller->getUrl($meter, $isDecode);
    }

    /**
     * 通过参数生成url
     * @return string
     */
    public function toUrl(): string
    {
        return call_user_func_array([$this->controller->getRequest(), 'toUrl'], func_get_args());
    }

    /**
     * 翻译
     * @param $word
     * @param array $arg
     * @param string $lang
     * @return mixed|string|string[]
     */
    public function t($word, $arg = [], $lang = '')
    {
        return $this->controller->t($word, $arg, $lang);
    }
}