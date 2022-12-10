<?php

namespace src\BO;

use src\DTO\BrandDTO;
use src\Factory\BrandDtoFactory;
use src\Api\Response;
use src\DAO\BrandDAO;
use src\Enums\FieldsEnum;

class BrandBO extends BasicBO
{
    public BrandDAO $dao;
    public BrandDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new BrandDAO('brand');
        $this->factory = new BrandDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $brand): void
    {
        $this->validateFields($paramsFields, $brand);
        if ($this->dao->findByCode($brand->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByName($brand->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $brand): void
    {
        $this->validateFields($paramsFields, $brand);
        if (!$this->dao->findById($brand->id)) {
            Response::RenderNotFound();
        }
        if ($this->dao->findByCodeExceptId($brand->code, $brand->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByNameExceptId($brand->name, $brand->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function insert(BrandDTO $brand): void
    {
        $columns = 'brand_code, brand_name';
        $values = ':code, :name';
        $params = array(
            'code' => $brand->getCode(),
            'name' => $brand->getName(),
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(BrandDTO $brand)
    {
        $values = 'brand_code = :code, brand_name = :name';
        $where = 'brand_id = :id';
        $params = array(
            'id' => $brand->getId(),
            'code' => $brand->getCode(),
            'name' => $brand->getName(),
        );
        $this->dao->update($values, $where, $params);
    }

    public function populateDbToDto(array $brand): BrandDTO
    {
        $brandDTO = new BrandDTO();
        $brandDTO->setId($brand['brand_id']);
        $brandDTO->setName($brand['brand_name']);
        $brandDTO->setCode($brand['brand_code']);
        return $brandDTO;
    }
}