<?php

namespace src\Factory;

use src\DTO\SizeDTO;

class SizeDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $size): SizeDTO
    {
        $sizeFactored = new SizeDTO();
        $sizeFactored->setCode($size->code);
        $sizeFactored->setName($size->name);
        $sizeFactored->setId($size->id ?? null);
        return $sizeFactored;
    }

    public function makePublic(SizeDTO $size): \stdClass
    {
        $sizePublic = new \stdClass();
        $sizePublic->id = $size->getId();
        $sizePublic->code = $size->getCode();
        $sizePublic->name = $size->getName();
        return $sizePublic;
    }

    public function populateDbToDto(array $size): SizeDTO
    {
        $sizeDTO = new SizeDTO();
        $sizeDTO->setId($size['size_id']);
        $sizeDTO->setName($size['size_name']);
        $sizeDTO->setCode($size['size_code']);
        return $sizeDTO;
    }
}