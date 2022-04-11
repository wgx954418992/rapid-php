<?php


namespace apps\queue\classier\event;


use apps\core\classier\model\AppQueueModel;
use Exception;
use rapidPHP\modules\reflection\classier\Property;
use rapidPHP\modules\reflection\classier\Utils;

class QueueEvent extends AppQueueModel
{

    /**
     * QueueEvent constructor.
     * @param null $data
     * @throws Exception
     */
    public function __construct($data = null)
    {
        if (is_object($data)) {
            $data = Utils::getInstance()->toArray($data);
        }

        parent::__construct($data);
    }

    /**
     * 转data 只转自身，不转继承的
     * @return array
     * @throws Exception
     */
    public function toSelfData(): array
    {
        $currentClassname = get_class($this);

        return Utils::getInstance()->toArray($this, function (Property $property) use ($currentClassname) {
            return $property->getDeclaringClass()->getName() == $currentClassname;
        });
    }

    /**
     * 转json  只转自身，不转继承的
     * @return string
     * @throws Exception
     */
    public function toSelfJson(): string
    {
        return parent::toJson($this->toSelfData());
    }
}