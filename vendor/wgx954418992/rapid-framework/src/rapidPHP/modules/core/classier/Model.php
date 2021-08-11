<?php

namespace rapidPHP\modules\core\classier;


use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Xml;
use rapidPHP\modules\reflection\classier\Utils;

class Model
{

    /**
     * name
     */
    const NAME = null;

    /**
     * 获取模式
     */
    const MODEL_GET = 1;

    /**
     * 删除模式
     */
    const MODEL_DEL = 2;

    /**
     * Model constructor.
     * @param $data
     * @throws Exception
     */
    public function __construct($data = null)
    {
        Utils::getInstance()->toObject($this, !is_null($data) ? $data : []);
    }

    /**
     * 获取数据
     * @param array|null $names
     * @param int $mode 1获取names下的values 2,排除names下的values
     * @return array
     * @throws Exception
     */
    public function toData(?array $names = null, int $mode = self::MODEL_GET): array
    {
        $array = Utils::getInstance()->toArray($this);

        if (!empty($names)) {
            switch ($mode) {
                case self::MODEL_GET:
                    return AR::getInstance()->getArray($array, $names);
                case self::MODEL_DEL:
                    return AR::getInstance()->delete($array, $names);
            }
        }

        return $array;
    }

    /**
     * 转xml
     * @param array|null $names
     * @return string
     * @throws Exception
     */
    public function toXml(?array $names = null): string
    {
        return Xml::getInstance()->encode($this->toData($names));
    }

    /**
     * 转json
     * @param array|null $names
     * @return string
     * @throws Exception
     */
    public function toJson(?array $names = null): string
    {
        return json_encode($this->toData($names));
    }

    /**
     * 删除指定value
     * @param $names
     * @return static
     */
    public function delValue($names): Model
    {
        if (is_array($names)) {
            foreach ($names as $key) if (isset($this->$key)) unset($this->$key);
        } else {
            unset($this->$names);
        }

        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
