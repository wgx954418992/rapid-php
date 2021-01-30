<?php


namespace apps\admin\classier\wrapper;

use apps\core\classier\model\AdminRoleModel;
use apps\core\classier\model\AdminRouteModel;
use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\B;

class RouteWrapper extends AdminRouteModel
{

    /**
     * @var AdminRoleModel|null
     */
    private $role;

    /**
     * @var RouteWrapper[]|null
     */
    private $child;

    /**
     * @return array|int|mixed|object|string|null
     */
    public function getOptions()
    {
        return B()->jsonDecode(parent::getOptions());
    }

    /**
     * @return AdminRoleModel|null
     */
    public function getRole(): ?AdminRoleModel
    {
        return $this->role;
    }

    /**
     * @param AdminRoleModel|null $role
     */
    public function setRole(?AdminRoleModel $role): void
    {
        $this->role = $role;
    }

    /**
     * @return RouteWrapper[]|null
     */
    public function getChild(): ?array
    {
        return $this->child;
    }

    /**
     * @param RouteWrapper[]|null $child
     * @throws Exception
     */
    public function setChild(?array $child): void
    {
        Utils::getInstance()->toObjects(RouteWrapper::class, $child);

        $this->child = $child;
    }
}