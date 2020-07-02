<?php

namespace rapidPHP\library;

use Exception;
use rapid\library\rapid;
use rapidPHP\library\core\app\Controller;
use rapidPHP\library\core\Loader;
use ReflectionException;

class ViewTemplate
{
    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var string 文件名
     */
    private $fileName = '';

    /**
     * @var AB 变量集合
     */
    public $data = null;

    /**
     * @var null|string 模板目录
     */
    private $templateDir = '';

    /**
     * @var string 缓存目录
     */
    private $cacheDir = '';

    /**
     * @var array 默认后缀
     */
    private $defaultExt = ['php', 'html', 'htm'];

    /**
     * View constructor.
     * @param Controller $controller
     * @param $fileName
     * @param null $templateDir
     * @param null $cacheDir
     */
    public function __construct(Controller $controller, $fileName, $templateDir = null, $cacheDir = null)
    {
        $this->data = new AB();

        $this->controller = $controller;

        $this->fileName = $fileName;

        $this->templateDir = is_null($templateDir) ? ROOT_PUBLIC . 'src/view/' : $templateDir;

        $this->cacheDir = is_null($cacheDir) ? ROOT_RUNTIME . 'build/view/' : $cacheDir;
    }

    /**
     * 设置模版目录
     * @param $dir
     * @param string $path
     * @return $this
     */
    public function setTemplateDir($dir, $path = ROOT_PATH)
    {
        $this->templateDir = $path . $dir;

        return $this;
    }

    /**
     * 获取模板目录
     * @return string
     */
    public function getTemplateDir()
    {
        return $this->templateDir;
    }

    /**
     * 设置缓存目录
     * @param $dir
     * @param string $path
     * @return $this
     */
    public function setCacheDir($dir, $path = ROOT_PATH)
    {
        $this->cacheDir = $path . $dir;
        return $this;
    }


    /**
     * 获取缓存目录
     * @return null|string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * 获取缓存文件路径
     * @return string
     */
    public function getCacheFilePath()
    {
        $fileInfo = $this->getFileInfo($this->fileName);

        return $this->getCacheDir() . $fileInfo['dir'] . $fileInfo['prefix'] . '.php';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return self
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultExt(): array
    {
        return $this->defaultExt;
    }

    /**
     * @param array $defaultExt
     */
    public function setDefaultExt(array $defaultExt): void
    {
        $this->defaultExt = $defaultExt;
    }

    /**
     * 设置变量
     * @param $key :key或者数据
     * @param string $value 值
     * @return $this
     * @throws ReflectionException
     */
    public function assign($key, $value = '')
    {
        if (($key instanceof AB) || is_array($key)) {
            $this->data->sData($key);
        } else {
            $this->data->sValue($key, $value);
        }

        return $this;
    }

    /**
     * 读取文件
     * @param $file
     * @return bool|string
     */
    private function readFile($file)
    {
        if (is_file($file)) return file_get_contents($file);

        return false;
    }

    /**
     * 获取文件信息
     * @param $fileName
     * @return array
     */
    private function getFileInfo($fileName)
    {
        return B()->getPathInfo($fileName);
    }

    /**
     * 获取模板目录
     * @param $fileInfo
     * @return mixed
     */
    private function getTemplatePathDir($fileInfo)
    {
        $fileInfoDir = ltrim($fileInfo['dir'], "/*");

        if (empty($fileInfoDir)) return $this->getTemplateDir();

        if (is_dir($fileInfoDir)) {
            return $fileInfoDir;
        } else if (is_dir($this->getTemplateDir() . $fileInfoDir)) {
            return $this->getTemplateDir() . $fileInfoDir;
        } else if (is_dir(ROOT_PATH . $fileInfoDir)) {
            return ROOT_PATH . $fileInfoDir;
        } else {
            return $this->getTemplateDir();
        }
    }

    /**
     * 获取文件名
     * @param $fileInfo
     * @param $fileName
     * @return mixed
     */
    private function getTemplatePathFileName($fileInfo, $fileName)
    {
        $prefix = $fileInfo['prefix'];

        return B()->contrast($prefix, $fileName);
    }

    /**
     * 获取文件名后缀
     * @param $file
     * @param $fileInfo
     * @return mixed
     */
    private function getTemplatePathExt($file, $fileInfo)
    {
        $suffix = $fileInfo['suffix'];

        if ($suffix) return $suffix;

        foreach ($this->defaultExt as $ext) {
            if (is_file("{$file}.{$ext}")) return $ext;
        }

        return '';
    }

    /**
     * 获取模版路径
     * @param $fileName
     * @return string
     */
    private function getTemplatePath($fileName)
    {
        $fileInfo = $this->getFileInfo($fileName);

        $dir = $this->getTemplatePathDir($fileInfo);

        $name = $this->getTemplatePathFileName($fileInfo, $fileName);

        $file = "{$dir}{$name}";

        $ext = $this->getTemplatePathExt($file, $fileInfo);

        return "{$dir}{$name}.{$ext}";
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
            $fileName = Loader::formatPath($this->getTemplatePath($include));

            $strings = $this->readFile($fileName);

            $strings = $this->compile($strings, $fileName);

            $pattern = B()->getData($patterns, $index);

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

        $patterns = B()->getData($data, 0);

        $includes = B()->getData($data, 1);

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
     * @param $fileSrc
     * @return mixed
     */
    private function compile($strings, $fileSrc)
    {
        $likeRule = $this->getCompileLikeRule($strings, $fileSrc);

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
        $result = (array)B()->getRegularAll("#(\.\./|\./)#i", $value);

        if (count($result) === 0) {
            $pathDir = "$dir/$value";
        } else {
            $path = count($result) === 1 && $result[0] === './' ? "$dir/" : B()->dirName($dir, count($result));

            $pathDir = str_replace(join('', $result), $path, $value);
        }
        return $pathDir;
    }

    /**
     * 获取编译链接规则列表
     * @param $list
     * @param $fileSrc
     * @return mixed
     */
    private function getCompileLikeRuleList($list, $fileSrc)
    {
        $rule = [];

        $dir = str_replace(ROOT_PATH, "/", dirname($fileSrc));

        $appRootUrl = B()->deleteStringLast($this->controller->getHostUrl());

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
     * @param $fileSrc
     * @return mixed
     */
    private function getCompileLikeRule($strings, $fileSrc)
    {
        $likeList = $this->getCompileLikeList($strings);

        return $this->getCompileLikeRuleList($likeList, $fileSrc);
    }


    /**
     * @param $compileResult
     * @return string
     */
    private function putCompileResultHeader($compileResult)
    {
        return "<?php /** cache Time " . B()->getDate() . " */ if(!defined('SWOOLE_HTTP_SERVER')) defined('ROOT_PATH') or die();?>\n{$compileResult}";
    }

    /**
     * 缓存
     * @param $context
     * @param $filePath
     * @return bool|string
     * @throws Exception
     */
    private function cache($context, $filePath)
    {
        $dirPath = dirname($filePath);

        if (!is_dir($dirPath) && !mkdir($dirPath, 0777, true)) {
            throw new Exception('create dir fail!');
        } else {
            $cachePath = $filePath;

            if (!file_exists($cachePath) || $this->readFile($cachePath) != $context) {

                if (file_put_contents($cachePath, $context)) return $cachePath;

            } else {
                return $cachePath;
            }
        }
        return false;
    }

    /**
     * @param null $name
     * @return array|null|AB|string
     */
    public function get($name = null)
    {
        return is_null($name) ? $this->data : $this->data->getValue($name);
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
     * 显示
     * @param bool $isReturnContent 是否返回编译后的文件内容
     * @return false|string|null
     * @throws Exception
     */
    public function view($isReturnContent = false)
    {
        $fileSrc = Loader::formatPath($this->getTemplatePath($this->fileName));

        $cacheFile = $this->getCacheFilePath();

        if (is_file($cacheFile) && (filemtime($cacheFile) >= filemtime($fileSrc))) {
            $content = $this->getIncludeContents($cacheFile);

            $this->controller->getResponse()->write($content);

            return $isReturnContent ? $content : null;
        }

        if (is_file($fileSrc) && $fileContext = $this->readFile($fileSrc)) {

            $string = $this->preIncludes($fileContext);

            $compileResult = $this->compile($string, $fileSrc);

            $compileResult = $this->putCompileResultHeader($compileResult);

            if ($fileName = $this->cache($compileResult, $this->getCacheFilePath())) {

                $content = $this->getIncludeContents($fileName);

                $this->controller->getResponse()->write($content);

                return $isReturnContent ? $content : null;
            }
        }

        throw new Exception('view error!');
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
     * @return Controller
     */
    public function getController()
    {
        return $this->controller;
    }
}