<?php

namespace src\Factory;

use src\DTO\ColorDTO;
use stdClass;

class ColorDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): ColorDTO
    {
        $colorFactored = new ColorDTO();
        $colorFactored->setCode($item->code);
        $colorFactored->setName($item->name);
        $colorFactored->setId($item->id ?? null);
        return $colorFactored;
    }

    /**
     * @param ColorDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $colorPublic = new stdClass();
        $colorPublic->id = $item->getId();
        $colorPublic->code = $item->getCode();
        $colorPublic->name = $item->getName();
        return $colorPublic;
    }

    public function populateDbToDto(array $item): ColorDTO
    {
        $colorDTO = new ColorDTO();
        $colorDTO->setId($item['color_id']);
        $colorDTO->setName($item['color_name']);
        $colorDTO->setCode($item['color_code']);
        return $colorDTO;
    }
}