<?php

namespace src\Factory;

use src\DTO\BrandDTO;

class BrandDtoFactory
{
    public static function factory(\stdClass $brand): BrandDTO
    {
        $brandFactored = new BrandDTO();
        $brandFactored->setId($brand->id ?? null);
        $brandFactored->setName($brand->name);
        $brandFactored->setCode($brand->code);
        return $brandFactored;
    }

    public static function makePublic(BrandDTO $brand): \stdClass
    {
        $brandPublic = new \stdClass();
        $brandPublic->id = $brand->getId();
        $brandPublic->name = $brand->getName();
        $brandPublic->code = $brand->getCode();
        return $brandPublic;
    }
}