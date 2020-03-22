<?php

namespace rapidPHP\library;

use rapid\library\rapid;
use rapidPHP\library\core\Loader;

class ViewTemplate
{
    /**
     * @var string 文件名
     */
    private $fileName = '';

    /**
     * @var array 变量集合
     */
    private $varList = [];

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
     * @var string 编译结果
     */
    private $compileResult = '';

    /**
     * @var AB varAryObj
     */
    private $varAryObj = null;

    /**
     * View constructor.
     * @param $fileName
     * @param null $templateDir
     * @param null $cacheDir
     */
    public function __construct($fileName, $templateDir = null, $cacheDir = null)
    {
        $this->fileName = $fileName;

        $this->cacheDir = is_null($cacheDir) ? ROOT_RUNTIME . 'build/view/' : $cacheDir;

        $this->templateDir = is_null($templateDir) ? ROOT_PUBLIC . 'src/view/' : $templateDir;
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
     * 设置变量
     * @param $key :key或者数据
     * @param string $value 值
     * @return $this
     */
    public function assign($key, $value = '')
    {
        if ($key instanceof AB) {
            $this->varList = array_merge($key->getData(), $this->varList);
        } else if (is_array($key)) {
            $this->varList = array_merge($key, $this->varList);
        } else {
            $this->varList[$key] = $value;
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
     * @return AB
     */
    private function getFileInfo($fileName)
    {
        $fileInfo = B()->getPathInfo($fileName);

        return new AB($fileInfo);
    }

    /**
     * 获取模板目录
     * @param $fileInfo
     * @return mixed
     */
    private function getTemplatePathDir(AB $fileInfo)
    {
        $fileInfoDir = ltrim($fileInfo->getString('dir'), "/*");

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
    private function getTemplatePathFileName(AB $fileInfo, $fileName)
    {
        $prefix = $fileInfo->getString('prefix');

        return B()->contrast($prefix, $fileName);
    }

    /**
     * 获取文件名后缀
     * @param $file
     * @param $fileInfo
     * @return mixed
     */
    private function getTemplatePathExt($file, AB $fileInfo)
    {
        $suffix = $fileInfo->getString('suffix');

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
     * 解析
     * @param array $varList
     * @return $this
     */
    public function display($varList = [])
    {
        $this->assign($varList);

        $fileSrc = Loader::formatPath($this->getTemplatePath($this->fileName));

        if (is_file($fileSrc) && $fileContext = $this->readFile($fileSrc)) {

            $string = $this->preIncludes($fileContext);

            $this->compileResult = $this->compile($string, $fileSrc);
        }

        return $this;
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

        $appRootUrl = B()->deleteStringLast(APP_ROOT_URL);

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
        return "<?php defined('ROOT_PATH') or die();?>\n{$compileResult}";
    }

    /**
     * 缓存
     * @param $context
     * @param $fileName
     * @param $filePath
     * @return bool|string
     */
    private function cache($context, $fileName, $filePath)
    {
        if (!is_dir($filePath) && !mkdir($filePath, 0777, true)) {
            exit('create dir fail!');
        } else {
            $cachePath = $filePath . $fileName;

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
        return is_null($name) ? $this->varAryObj : $this->varAryObj->getValue($name);
    }

    /**
     * 显示
     */
    public function view()
    {
        $this->compileResult = $this->putCompileResultHeader($this->compileResult);

        $fileInfo = $this->getFileInfo($this->fileName);

        $filePath = $this->getCacheDir() . $fileInfo->getString('dir');

        if ($fileName = $this->cache($this->compileResult, $fileInfo->getString('prefix') . '.php', $filePath)) {

            $this->varAryObj = new AB($this->varList);

            include $fileName . '';
        } else {
            exit('view error!');
        }
    }
}