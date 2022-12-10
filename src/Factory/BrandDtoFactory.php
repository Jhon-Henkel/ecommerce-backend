<?php

namespace src\Factory;

use src\DTO\BrandDTO;

class BrandDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $brand): BrandDTO
    {
        $brandFactored = new BrandDTO();
        $brandFactored->setId($brand->id ?? null);
        $brandFactored->setName($brand->name);
        $brandFactored->setCode($brand->code);
        return $brandFactored;
    }

    public function makePublic(BrandDTO $brand): \stdClass
    {
        $brandPublic = new \stdClass();
        $brandPublic->id = $brand->getId();
        $brandPublic->name = $brand->getName();
        $brandPublic->code = $brand->getCode();
        return $brandPublic;
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