<?php

namespace src\Factory;

use src\DTO\SizeDTO;

class SizeDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): SizeDTO
    {
        $sizeFactored = new SizeDTO();
        $sizeFactored->setCode($item->code);
        $sizeFactored->setName($item->name);
        $sizeFactored->setId($item->id ?? null);
        return $sizeFactored;
    }

    /**
     * @param SizeDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        $sizePublic = new \stdClass();
        $sizePublic->id = $item->getId();
        $sizePublic->code = $item->getCode();
        $sizePublic->name = $item->getName();
        return $sizePublic;
    }

    public function populateDbToDto(array $item): SizeDTO
    {
        $sizeDTO = new SizeDTO();
        $sizeDTO->setId($item['size_id']);
        $sizeDTO->setName($item['size_name']);
        $sizeDTO->setCode($item['size_code']);
        return $sizeDTO;
    }
}