<?php

namespace apps\admin\classier\context;

use apps\admin\classier\bean\RoleListCondition;
use apps\admin\classier\service\BaseService;
use apps\admin\classier\service\RoleService;
use apps\admin\classier\wrapper\RouteWrapper;
use apps\core\classier\enum\TokenKey;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;

class AdminContext
{

    /**
     * @var string
     */
    private $token;

    /**
     * @var WebContext
     */
    private $context;

    /**
     * @var AdminWrapper
     */
    private $adminWrapper;

    /**
     * @var array
     */
    private $routes;

    /**
     * @var array
     */
    private $roles;

    /**
     * AdminContext constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        $this->context = $context;

        $this->token = $this->context->getRequest()->cookie(TokenKey::ADMIN);

        try {
            $this->adminWrapper = BaseService::getInstance()->getTokenAdmin($this->token);

            try {
                $this->routes = RoleService::getInstance()->getRoutes();

                $condition = new RoleListCondition();

                $condition->setAdminId($this->adminWrapper->getId());

                $this->roles = RoleService::getInstance()->getRoles($condition);
            } catch (Exception $e) {

            }
        } catch (Exception $e) {
            $this->token = null;

//            $this->context->getResponse()->cookie(TokenKey::ADMIN, null);
        }
    }

    /**
     * 获取token
     * @return mixed
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * 获取管理员信息
     * @return AdminWrapper|null
     */
    public function getCurrentAdmin()
    {
        return $this->adminWrapper;
    }

    /**
     * @return array|null
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return array|null
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * 获取合并 role 到 route 的list
     * @return RouteWrapper[]|null
     * @throws Exception
     */
    public function getMergeRoleToRouteList()
    {
        return RoleService::getInstance()->getMergeRoleToRouteList($this->getRoutes(), $this->getRoles());
    }
}
