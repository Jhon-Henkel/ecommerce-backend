<?php

namespace src\BO;

use src\DTO\BrandDTO;
use src\Factory\BrandDtoFactory;
use stdClass;
use src\Api\Response;
use src\DAO\BrandDAO;
use src\Enums\FieldsEnum;
use src\Tools\ValidateTools;

class BrandBO
{
    /**
     * @param array $paramsFields
     * @param stdClass $brand
     * @return void
     */
    public function validatePostParamsApi(array $paramsFields, stdClass $brand): void
    {
        $brandDAO = new BrandDAO();
        $this->validateFields($paramsFields, $brand);
        if ($brandDAO->findByCode($brand->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($brandDAO->findByName($brand->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function validatePutParamsApi(array $paramsFields, stdClass $brand): void
    {
        $brandDAO = new BrandDAO();
        $this->validateFields($paramsFields, $brand);
        if (!$brandDAO->findById($brand->id)) {
            Response::RenderNotFound();
        }
        if ($brandDAO->findByCodeExceptId($brand->code, $brand->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($brandDAO->findByNameExceptId($brand->name, $brand->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function validateFields(array $paramsFields, stdClass $brand): void
    {
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$brand)) {
            Response::RenderRequiredAttributesMissing();
        }
    }

    public function findLastInserted(): BrandDTO
    {
        $brandDAO = new BrandDAO();
        $search = $brandDAO->findLastInserted();
        return $this->populateDbToDto($search);
    }

    public function populateDbToDto(array $brand): BrandDTO
    {
        $brandDTO = new BrandDTO();
        $brandDTO->setId($brand['brand_id']);
        $brandDTO->setName($brand['brand_name']);
        $brandDTO->setCode($brand['brand_code']);
        return $brandDTO;
    }

    public function findById(int $id): ?BrandDTO
    {
        $brandDAO = new BrandDAO();
        $brand = $brandDAO->findById($id);
        return $brand ? $this->populateDbToDto($brand) : null;
    }

    public function findAll(): ?array
    {
        $brandDAO = new BrandDAO();
        $brands = $brandDAO->findAll();
        if (!$brands) {
            return null;
        }
        return $this->makeBrandsPublic($brands);
    }

    public function makeBrandsPublic(array $brands): array
    {
        $brandsFactored = array();
        foreach ($brands as $brand) {
            $brandDto = $this->populateDbToDto($brand);
            $brandsFactored[] = BrandDtoFactory::makePublic($brandDto);
        }
        return $brandsFactored;
    }

    public function deleteById(int $id): void
    {
        if (!$this->findById($id)) {
            Response::RenderNotFound();
        }
        $brandDAO = new BrandDAO();
        $brandDAO->deleteById($id);
    }
}