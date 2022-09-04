<?php

namespace rapidPHP\modules\common\classier;

use Exception;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\reflection\classier\Utils;

class RESTFulApi
{

    /**
     * 失败状态
     */
    const CODE_FAIL = 0;

    /**
     * 成功状态
     */
    const CODE_SUCCESS = 1;

    /**
     * @var array 结果
     */
    protected $result = [];

    /**
     * @var string
     */
    protected $dataKey, $codeKey, $msgKey;

    /**
     * 构造函数，设置参数
     * api constructor.
     * @param string $dataKey
     * @param string $codeKey
     * @param string $msgKey
     */
    public function __construct(string $codeKey = 'code', string $msgKey = 'msg', string $dataKey = 'data')
    {
        $this->setDataKey($dataKey)->setMsgKey($msgKey)->setRetKey($codeKey);
    }

    /**
     * @param array|string|null|object $result
     * @throws Exception
     */
    public function setResult($result)
    {
        if (is_string($result)) {
            $result = json_decode($result, true);

            if (empty($result)) $result = Xml::getInstance()->decode($result);
        } else if ($result instanceof Model) {
            $result = $result->toData();
        } else if ($result instanceof AB) {
            $result = $result->toData();
        }

        $this->result = $result;
    }

    /**
     * 设置返回key
     * @param mixed $dataKey
     * @return self|static
     */
    public function setDataKey($dataKey)
    {
        $this->dataKey = $dataKey;

        return $this;
    }

    /**
     * 设置返回状态key
     * @param mixed $codeKey
     * @return self|static
     */
    public function setRetKey($codeKey)
    {
        $this->codeKey = $codeKey;

        return $this;
    }


    /**
     * 设置返回状态key
     * @param mixed $msgKey
     * @return self|static
     */
    public function setMsgKey($msgKey)
    {
        $this->msgKey = $msgKey;

        return $this;
    }


    /**
     * 预设返回值
     * @param string $msg
     * @param $data
     * @param int|string $code
     * @return $this
     * @throws Exception
     */
    public function go(string $msg = '', $data = null, $code = 0)
    {
        $this->setMsg($msg);

        $this->setData($data);

        $this->setCode($code);

        return $this;
    }


    /**
     * 设置返回消息
     * @param $msg
     * @return self|static
     */
    public function setMsg($msg)
    {
        $this->result[$this->msgKey] = $msg;

        return $this;
    }


    /**
     * 设置返回状态
     * @param $code
     * @return self|static
     */
    public function setCode($code)
    {
        $this->result[$this->codeKey] = $code;

        return $this;
    }

    /**
     * 设置返回状态
     * @param $data
     * @return self|static
     * @throws Exception
     */
    public function setData($data)
    {
        if ($data instanceof Model) {
            $data = $data->toData();
        } else if ($data instanceof AB) {
            $data = $data->toData();
        } else if (is_object($data) || is_array($data)) {
            $data = Utils::getInstance()->toArray($data);
        }

        $this->result[$this->dataKey] = $data;

        return $this;
    }


    /**
     * 获取结果状态
     * @param $result
     * @return array|null|string
     */
    public function getCode($result)
    {
        return Build::getInstance()->getData($result, $this->codeKey);
    }

    /**
     * 获取结果消息
     * @param $result
     * @return array|null|string
     */
    public function getMsg($result)
    {
        return Build::getInstance()->getData($result, $this->msgKey);
    }

    /**
     * 获取结果数据
     * @param $result
     * @return array|null|string
     */
    public function getData($result)
    {
        return Build::getInstance()->getData($result, $this->dataKey);
    }


    /**
     * 获取返回值
     * @return array
     */
    public function getResult(): array
    {
        if (!isset($this->result)) $this->result = [$this->codeKey => RESTFulApi::CODE_FAIL, $this->msgKey => 'error', $this->dataKey => null];

        return $this->result;
    }

    /**
     * 转json
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->getResult());
    }

    /**
     * 转json
     * @return string
     */
    public function toXml(): string
    {
        return Xml::getInstance()->encode($this->getResult());
    }

    /**
     * 错误
     * @param $msg
     * @param int|string $code
     * @param $data
     * @return RESTFulApi
     * @throws Exception
     */
    public static function error($msg, $code = self::CODE_FAIL, $data = null)
    {
        return (new static())->go($msg, $data, $code);
    }

    /**
     * 成功
     * @param $data
     * @param string|array $msg
     * @param int|string $code
     * @return RESTFulApi
     * @throws Exception
     */
    public static function success($data = null, $msg = 'success!', $code = self::CODE_SUCCESS)
    {
        return (new static())->go($msg, $data, $code);
    }
}
