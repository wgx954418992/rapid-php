<?php

namespace apps\admin\classier\controller\account;


use apps\admin\classier\service\AccessService;
use apps\core\classier\model\AdminCodeModel;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class AccessController
 * @route /account/access
 * @package apps\admin\classier\controller\account
 */
class AccessController extends ValidaAccountController
{

    /**
     * 获取权限Code列表
     * @route /code/list
     * @method get
     * @typed auto
     * @access ADMIN:ACCESS:CODE:LIST
     * @template account/access/code/list
     * @return array
     * @throws Exception
     */
    public function getAccessCodeList()
    {
        $data = AccessService::getInstance()->getCodeList();

        return [
            'list' => $data,
        ];
    }


    /**
     * 添加编辑权限code
     * @route /code/added
     * @typed auto
     * @access ADMIN:ACCESS:CODE:ADDED
     * @template account/access/code/added
     * @param $submit
     * @param AdminCodeModel $codeModel
     * @return AdminCodeModel
     * @throws Exception
     */
    public function addedAccessCode($submit, AdminCodeModel $codeModel)
    {
        if (!empty($submit)) {
            $adminModel = AccessService::getInstance()->addedCode($codeModel);
        } else {
            if (!empty($codeModel->getId())) {
                $adminModel = AccessService::getInstance()->getCode($codeModel->getId());
            } else {
                $adminModel = new AdminCodeModel();
            }
        }

        return $adminModel;
    }

    /**
     * 删除code
     * @route /code/{codeId}/del
     * @typed api
     * @method post
     * @access ADMIN:ACCESS:CODE:DEL
     * @param $codeId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delAccessCode($codeId)
    {
        AccessService::getInstance()->delCode($codeId);

        return RESTFulApi::success(null, '删除成功');
    }

}
