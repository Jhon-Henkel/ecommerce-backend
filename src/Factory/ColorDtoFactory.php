<?php

namespace src\Factory;

use src\DTO\ColorDTO;

class ColorDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $color): ColorDTO
    {
        $colorFactored = new ColorDTO();
        $colorFactored->setCode($color->code);
        $colorFactored->setName($color->name);
        $colorFactored->setId($color->id ?? null);
        return $colorFactored;
    }

    public function makePublic(ColorDTO $color): \stdClass
    {
        $colorPublic = new \stdClass();
        $colorPublic->id = $color->getId();
        $colorPublic->code = $color->getCode();
        $colorPublic->name = $color->getName();
        return $colorPublic;
    }

    public function populateDbToDto(array $color): ColorDTO
    {
        $colorDTO = new ColorDTO();
        $colorDTO->setId($color['color_id']);
        $colorDTO->setName($color['color_name']);
        $colorDTO->setCode($color['color_code']);
        return $colorDTO;
    }
}