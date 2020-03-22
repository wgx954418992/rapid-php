<?php

use rapidPHP\config\DatabaseConfig;
use rapidPHP\library\Db;

require(dirname(__DIR__) . '/rapidPHP/init.php');

if (!APP_RUNNING_IS_SHELL) exit();

$conversion = [
    'int' => [
        'int',
        'integer',
        'numeric',
        'year',
    ], 'double' => [
        'double'
    ], 'float' => [
        'float'
    ], 'array' => [
        'json'
    ],
];

$conversionMapping = [];

foreach ($conversion as $type => $value) foreach ($value as $t) $conversionMapping[$t] = $type;

/**
 * 把数据库字段类型转换成 php强类型
 * @param $type
 * @return mixed|string
 */
function getConversionType($type)
{
    global $conversionMapping;

    if (!version_compare(PHP_VERSION, '7.0.0')) return "";

    return B()->getData($conversionMapping, $type);
}

function getConfig($config = null)
{
    if (!$config) $config = "default";

    $config = isset(DatabaseConfig::$$config) ? DatabaseConfig::$$config : null;

    return $config;
}

/**
 * @param $config
 * @return mixed|null
 */
function getConfigDatabase($config)
{
    return B()->getData($config, 'database');
}

/**
 * @param $config
 * @return mixed|null
 */
function getConfigModelFirst($config)
{
    return B()->getData($config, 'modelFirst');
}

/**
 * @param $config
 * @return mixed|null
 */
function getConfigModelPath($config)
{
    return B()->getData($config, 'modelPath');
}

/**
 * @param $config
 * @return mixed|null
 */
function getConfigModelNamespace($config)
{
    return B()->getData($config, 'modelNamespace');
}

/**
 * getTables
 * @param Db $db
 * @param $type
 * @return mixed
 * @throws Exception
 */
function getTables(Db $db, $type)
{
    return $db->table()->getTables($type, G_C_DATABASE)->get()->getResult();
}

/**
 * getTableColumn
 * @param Db $db
 * @param $type
 * @param $tableName
 * @return array
 * @throws Exception
 */
function getTableColumn(Db $db, $type, $tableName)
{
    return $db->table()->getTableStructure($type, G_C_DATABASE, $tableName)->get()->getResult();
}

/**
 * getTableCreateSql
 * @param Db $db
 * @param $type
 * @param $tableName
 * @return string
 * @throws Exception
 */
function getTableCreateSql(Db $db, $type, $tableName)
{
    $result = $db->table()->getTableCreateSql($type, G_C_DATABASE, $tableName)->get()->getArticle();

    foreach ($result as $value) {
        if (is_int(strpos(strtolower($value), 'create'))) {
            return $value;
        }
    }

    return null;
}

/**
 * getTypeClassText
 * @param $type
 * @return array|null|string
 */
function getTypeClassText($type)
{
    $typeList = [1 => 'tables', 2 => 'views'];

    return B()->getData($typeList, $type);
}

/**
 * 获取model 表的结构
 * @param $tableName
 * @param $comment
 * @param $columns
 * @return string
 */
function getModelTableString($tableName, $comment, $columns)
{
    $result = <<<EOF
\$table = [
        'name' => '{$tableName}',
        'comment' => '{$comment}',
        'column' => [
EOF;

    foreach ($columns as $column) {

        $columnName = B()->getData($column, 'name');

        $columnType = B()->getData($column, 'type');

        $columnLength = (int)B()->getData($column, 'length');

        $columnComment = B()->getData($column, 'comment');

        $result .= "
            '{$columnName}' => ['type' => '{$columnType}', 'length' => {$columnLength}, 'comment' => '{$columnComment}'],";
    }

    $result .= "
        ]
    ]";

    return $result;
}

/**
 * getInstanceClassString
 * @param $tableName
 * @param $comment
 * @param $columns
 * @return string
 */
function getModelClassString($tableName, $comment, $columns)
{
    $uTableName = B()->toFirstUppercase($tableName, '_');

    $className = "{$uTableName}Model";

    $namespace = G_C_MODEL_NAMESPACE;

    $table = getModelTableString($tableName, $comment, $columns);

    $classString = <<<EOF
<?php
namespace {$namespace};

use rapidPHP\library\AB;

/**
 * {$comment}
 */
class {$className} extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static {$table};

    /**
     * {$className} constructor.
     * @param array|null \$data
     */
    public function __construct(array \$data = null)
    {
        parent::__construct(\$data);
    }

EOF;

    foreach ($columns as $column) {

        $columnName = B()->getData($column, 'name');

        $columnComment = B()->getData($column, 'comment');

        $uColumnName = B()->toFirstUppercase($columnName, '_');

        $columnType = B()->getData($column, 'type');

        $conversionType = getConversionType($columnType);

        $classString .= <<<EOF
    
    /**
     * 获取 {$columnComment}
     * @return {getReturnType}
     */
    public function get{$uColumnName}(){returnType}
    {
        return \$this->getValue('{$columnName}');
    }
    
    /**
     * 设置 {$columnComment}
     * @param {paramSetType}\${$columnName}
     * @return {$className}
     */
    public function set{$uColumnName}({setType}\${$columnName})
    {
        return \$this->setValue('{$columnName}', \${$columnName});
    }

EOF;

        $returnType = empty($conversionType) ? "" : ": ?{$conversionType}";

        $getReturnType = empty($conversionType) ? "mixed" : "{$conversionType}";

        $setType = empty($conversionType) ? "" : "?{$conversionType} ";

        $paramSetType = empty($conversionType) ? "" : "{$conversionType} ";

        $classString = str_replace(['{returnType}', '{getReturnType}', '{setType}', '{paramSetType}'],
            [$returnType, $getReturnType, $setType, $paramSetType],
            $classString);
    }

    $classString .= <<<EOF
}
EOF;


    return $classString;
}


/**
 * write
 * @param $path
 * @param $fileName
 * @param $data
 */
function write($path, $fileName, $data)
{
    if (!is_dir($path)) if (!mkdir($path, 0777, true)) exit('mkdir error!');

    $path = rtrim($path,'/*');

    $file = fopen("{$path}/{$fileName}", 'w+');

    fwrite($file, $data);

    fclose($file);
}

/**
 * make
 * @param $db
 * @param $type
 * @throws Exception
 */
function make($db, $type)
{
    $tables = getTables($db, $type);

    $sql = [];

    foreach ($tables as $table) {

        $tableName = B()->getData($table, 'name');

        $comment = B()->getData($table, 'comment');

        $columns = getTableColumn($db, $type, $tableName);

        array_push($sql, getTableCreateSql($db, $type, $tableName));

        $modelClassString = getModelClassString($tableName, $comment, $columns);

        $uTableName = B()->toFirstUppercase($tableName, '_');

        write(G_C_MODEL_PATH, "{$uTableName}Model.class.php", $modelClassString);
    }

    $typeClassText = getTypeClassText($type);

    $randId = md5(G_C_DATABASE);

    write(ROOT_CONF, "database/{$randId}_{$typeClassText}.sql", join("\n\n", $sql));

    echo "{$typeClassText}编译完成\n";
}

$config = getConfig(B()->getData($argv, 1));

if (empty($config)) exit('config error！');

$database = getConfigDatabase($config);

if (empty($database)) exit('database error！');

$modelPath = getConfigModelPath($config);

if (empty($modelPath)) exit('modelPath error！');

$modelNamespace = getConfigModelNamespace($config);

if (empty($modelNamespace)) exit('modelNamespace error！');

$modelFirst = getConfigModelFirst($config);

define('G_C_DATABASE', $database);

define('G_C_MODEL_PATH', $modelPath);

define('G_C_MODEL_NAMESPACE', $modelNamespace);

define('G_C_MODEL_FIRST', $modelFirst);

try {
    $db = D($config);
} catch (Exception $e) {
    exit($e->getMessage());
}

/** 编译表 */
try {
    make($db, 1);
} catch (Exception $e) {
    echo $e->getMessage();
}

/** 编译视图 */
try {
    make($db, 2);
} catch (Exception $e) {
    echo $e->getMessage();
}



