<?php

namespace apps\admin\classier\dao\master\admin;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminCodeModel;
use Exception;

class CodeDao extends MasterDao
{

    /**
     * cache prefix
     */
    public const CACHE_PREFIX = 'admin_code';

    /**
     * CodeDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AdminCodeModel::class);
    }

    /**
     * @return string
     */
    public function getListCacheId(): string
    {
        return $this->getCacheId('list_x');
    }

    /**
     * 添加code
     * @param AdminCodeModel $codeModel
     * @return bool
     * @throws Exception
     */
    public function addCode(AdminCodeModel $codeModel): bool
    {
        $data = [
            'name' => $codeModel->getName(),
            'code' => $codeModel->getCode(),
            'remarks' => $codeModel->getRemarks(),
        ];

        if ($codeModel->getParentId()) $data['parent_id'] = $codeModel->getParentId();

        $result = $this->add($data, $id);

        if ($result) {
            $codeModel->setId($id);

            $this->delCache($this->getListCacheId());
        }

        return $result;
    }

    /**
     * set code
     * @param AdminCodeModel $codeModel
     * @return bool
     * @throws Exception
     */
    public function setCode(AdminCodeModel $codeModel): bool
    {
        $data = [
            'name' => $codeModel->getName(),
            'code' => $codeModel->getCode(),
            'remarks' => $codeModel->getRemarks(),
        ];

        if ($codeModel->getParentId()) $data['parent_id'] = $codeModel->getParentId();

        $result = $this->set($data)
            ->where('id', $codeModel->getId())
            ->execute();

        if ($result) parent::delCache($this->getListCacheId());

        return $result;
    }


    /**
     * 删除code
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delCode($id): bool
    {
        $result = $this->del()
            ->where('id', $id)
            ->execute();

        if ($result) parent::delCache($this->getListCacheId());

        return $result;
    }

    /**
     * 获取code信息
     * @param $id
     * @return AdminCodeModel|null
     * @throws Exception
     */
    public function getCode($id): ?AdminCodeModel
    {
        return $this->get()
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 通过code获取code信息
     * @param $code
     * @return AdminCodeModel|null
     * @throws Exception
     */
    public function getCodeByCode($code): ?AdminCodeModel
    {
        return $this->get()
            ->where('code', $code)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 获取Code list
     * @return AdminCodeModel[]
     * @throws Exception
     */
    public function getCodeList(): array
    {
        $cacheId = $this->getListCacheId();

        return (array)$this->getCacheWithCallback($cacheId, function () {
            return $this->get()
                ->getStatement()
                ->fetchAll($this->getModelOrClass());
        });
    }

}
