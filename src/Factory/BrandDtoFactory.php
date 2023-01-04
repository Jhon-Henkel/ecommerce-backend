<?php

namespace src\Factory;

use src\DTO\BrandDTO;
use stdClass;

class BrandDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): BrandDTO
    {
        $brandFactored = new BrandDTO();
        $brandFactored->setId($item->id ?? null);
        $brandFactored->setName($item->name);
        $brandFactored->setCode($item->code);
        return $brandFactored;
    }

    /**
     * @param BrandDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $brandPublic = new stdClass();
        $brandPublic->id = $item->getId();
        $brandPublic->name = $item->getName();
        $brandPublic->code = $item->getCode();
        return $brandPublic;
    }

    public function populateDbToDto(array $item): BrandDTO
    {
        $brandDTO = new BrandDTO();
        $brandDTO->setId($item['brand_id']);
        $brandDTO->setName($item['brand_name']);
        $brandDTO->setCode($item['brand_code']);
        return $brandDTO;
    }
}