<?php


namespace apps\admin\classier\wrapper\admin;

use apps\core\classier\model\AdminAccessModel;

class AccessWrapper extends AdminAccessModel
{

    /**
     * 权限code
     * @var string|null
     */
    protected $code;

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
