<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\bean\AddressListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppAddressModel;
use apps\core\classier\wrapper\AddressWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class AddressDao extends MasterDao
{

    /**
     * AddressDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppAddressModel::class);
    }

    /**
     * 添加地址信息
     * @param AppAddressModel $addressModel
     * @return bool
     * @throws Exception
     */
    public function addAddress(AppAddressModel $addressModel): bool
    {
        $data = [
            'name' => $addressModel->getName(),
            'bind_id' => $addressModel->getBindId(),
            'contact_name' => $addressModel->getContactName(),
            'telephone' => $addressModel->getTelephone(),
            'landline' => $addressModel->getLandline(),
            'area_id' => $addressModel->getAreaId(),
            'address' => $addressModel->getAddress(),
            'postcode' => $addressModel->getPostcode(),
            'type' => $addressModel->getType(),
            'is_delete' => false,
            'created_id' => $addressModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if($addressModel->getOriginalId()){
            $data['original_id'] = $addressModel->getOriginalId();
        }

        $result = parent::add($data, $id);

        if ($result) $addressModel->setId($id);

        return $result;
    }

    /**
     * 修改地址信息
     * @param AppAddressModel $addressModel
     * @return bool
     * @throws Exception
     */
    public function setAddress(AppAddressModel $addressModel): bool
    {
        $data = [
            'name' => $addressModel->getName(),
            'original_id' => $addressModel->getOriginalId(),
            'contact_name' => $addressModel->getContactName(),
            'telephone' => $addressModel->getTelephone(),
            'landline' => $addressModel->getLandline(),
            'area_id' => $addressModel->getAreaId(),
            'address' => $addressModel->getAddress(),
            'postcode' => $addressModel->getPostcode(),
            'type' => $addressModel->getType(),
            'updated_id' => $addressModel->getCreatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if($addressModel->getOriginalId()){
            $data['original_id'] = $addressModel->getOriginalId();
        }

        return parent::set($data)->where('id', $addressModel->getId())->execute();
    }

    /**
     * 获取地址信息
     * @param $id
     * @return AddressWrapper|null
     * @throws Exception
     */
    public function getAddress($id): ?AddressWrapper
    {
        /** @var AddressWrapper $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch(AddressWrapper::class);

        return $model;
    }

    /**
     * 通过bindId获取地址信息列表
     * @param $bindId
     * @return AddressWrapper[]
     * @throws Exception
     */
    public function getAddressByBind($bindId): array
    {
        return (array)parent::get()
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->getStatement()
            ->fetchAll(AddressWrapper::class);
    }

    /**
     * 通过bind_id+类型获取第一条地址信息
     * @param $bindId
     * @param $type
     * @return AddressWrapper|null
     * @throws Exception
     */
    public function getFirstAddressByBT($bindId, $type): ?AddressWrapper
    {
        /** @var AddressWrapper $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->where('type', $type)
            ->getStatement()
            ->fetch(AddressWrapper::class);

        return $model;
    }

    /**
     * 删除地址
     * @param $id
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function delAddress($id, $updatedId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $updatedId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }


    /**
     * 获取地址列表查询对象
     * @param AddressListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getAddressListSelect(AddressListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,`name`,telephone,landline,contact_name,address,postcode,area_id)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('id', $condition->getIds());

        if ($condition->getBindId()) $select->where('bind_id', $condition->getBindId());

        if ($condition->getType()) $select->where('type', $condition->getType());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false);
    }

    /**
     * 获取地址列表
     * @param AddressListCondition $condition
     * @return AddressWrapper[]|null
     * @throws Exception
     */
    public function getAddressList(AddressListCondition $condition): array
    {
        $select = $this->getAddressListSelect($condition);

//        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(AddressWrapper::class);
    }

    /**
     * 获取地址列表查询总数量
     * @param AddressListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getAddressListCount(AddressListCondition $condition): int
    {
        $select = $this->getAddressListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

}