<?php

namespace script\model\classier\handler;


use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\StrCharacter;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\config\PHPHandlerConfig;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;
use function rapidPHP\B;

abstract class IHandler
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
     * 获取UTableName
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @return string
     */
    public function getUTableName(IHandlerConfig $config, TableModel $table): string
    {
        $nameRules = (array)B()->getData((array)$config->getNameRules(), 'table');

        $tableName = $table->getName();

        $replaces = B()->getData($nameRules, 'replaces');

        if (is_array($replaces) && !empty($replaces)) {
            foreach ($replaces as $replace => $value) {
                if (substr($replace, 0, 1) === '$') {
                    $replace = substr($replace, 1);

                    if ($replace === substr($tableName, 0, mb_strlen($replace))) {
                        $tableName = $value . substr($tableName, min(mb_strlen($tableName), mb_strlen($replace)));
                    }
                } else {
                    $tableName = str_replace($replace, $value, $tableName);
                }
            }
        }

        $before = B()->getData($nameRules, 'before');

        if (is_string($before) && !empty($before)) $tableName = $before . $tableName;

        $after = B()->getData($nameRules, 'after');

        if (is_string($after) && !empty($after)) $tableName = $tableName . $after;

        $division = B()->contrast(B()->getData($nameRules, 'division'), '_');

        return StrCharacter::getInstance()->toFirstUppercase($tableName, $division);
    }

    /**
     * handler
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return string
     */
    abstract public function onHandler(IHandlerConfig $config, TableModel $table, $columns): string;
}
