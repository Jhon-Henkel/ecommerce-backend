<?php

namespace src\Factory;

use src\BO\ColorBO;
use src\DTO\ColorDTO;

class ColorDtoFactory
{
    public static function factory(\stdClass $color): ColorDTO
    {
        $colorFactored = new ColorDTO();
        $colorFactored->setCode($color->code);
        $colorFactored->setName($color->name);
        $colorFactored->setId($color->id ?? null);
        return $colorFactored;
    }

    public static function makePublic(ColorDTO $color): \stdClass
    {
        $colorPublic = new \stdClass();
        $colorPublic->id = $color->getId();
        $colorPublic->code = $color->getCode();
        $colorPublic->name = $color->getName();
        return $colorPublic;
    }

    public function makeItensPublic(array $categories): array
    {
        $bo = new ColorBO();
        $categoryFactored = array();
        foreach ($categories as $category) {
            $categoryDto = $bo->populateDbToDto($category);
            $categoryFactored[] = $this->makePublic($categoryDto);
        }
        return $categoryFactored;
    }
}