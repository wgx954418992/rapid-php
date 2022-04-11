<?php

namespace apps\tests;

use apps\admin\classier\dao\master\admin\CodeDao;
use apps\admin\classier\service\AccessService;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminCodeModel;
use Exception;
use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\router\classier\Mapping;
use rapidPHP\modules\router\classier\Route;
use function rapidPHP\B;

class AccessTest extends BaseTest
{

    /**
     * 扫描获取管理员权限list
     * @throws Exception
     */
    public function testAdminAccessList()
    {
        B()->onlyIdToInt();

        $path = PATH_ROOT . 'apps/admin/classier/controller/';

        Mapping::getInstance()->scanning($path, $routes, $actions);

        Utils::getInstance()->toObjects(Route::class, $routes);

        usort($routes, function ($a, $b) {

            return strcmp($b->getRoute(), $a->getRoute());
        });

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $result = [];

            /** @var Route $route */
            foreach ((array)$routes as $route) {

                $method = Classify::getInstance($route->getClassName())
                    ->getMethod($route->getMethodName());

                $docComment = $method->getDocComment();

                $name = trim(B()->getRegular('/\/\*\*\n.*\*(.*)/i', $docComment->getDoc()));

                /** @var Value $accessAnnotation */
                $accessAnnotation = $method->getDocComment()->getOneAnnotation('access');

                if (!$accessAnnotation) continue;

                $code = trim($accessAnnotation->getValue());

                $codeModel = CodeDao::getInstance()->getCodeByCode($code);

                if ($codeModel === null) {
                    $codeModel = new AdminCodeModel();

                    $codeModel->setName($name);

                    $codeModel->setCode($code);

                    $codeModel->setRemarks($route->getClassName() . '::' . $route->getMethodName());

                    if (!CodeDao::getInstance()->addCode($codeModel)) throw new Exception('添加code 失败');

                    $result[] = $codeModel->getId();
                } else {
                    $codeModel->setName($name);

                    $codeModel->setRemarks($route->getClassName() . '::' . $route->getMethodName());

                    if (!CodeDao::getInstance()->setCode($codeModel)) throw new Exception('修改code 失败');

                    $result[] = $codeModel->getId();
                }
            }

            AccessService::getInstance()->setAccessList(10001, $result);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交失败');

            echo "成功:" . count($result) . PHP_EOL;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }

    }
}
