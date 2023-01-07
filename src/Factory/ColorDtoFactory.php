<?php

namespace src\Factory;

use Exception;
use src\DTO\ColorDTO;
use src\Tools\DateTools;
use stdClass;

class ColorDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): ColorDTO
    {
        $colorFactored = new ColorDTO();
        $colorFactored->setCode($item->code);
        $colorFactored->setName($item->name);
        $colorFactored->setId($item->id ?? null);
        $colorFactored->setCreatedAt($item->createdAt ?? null);
        $colorFactored->setUpdatedAt($item->updatedAt ?? null);
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
        $colorPublic->createdAt = DateTools::dateTimeToStringConverter($item->getCreatedAt());
        $colorPublic->updatedAt = DateTools::dateTimeToStringConverter($item->getUpdatedAt());
        return $colorPublic;
    }

    /**
     * @throws Exception
     */
    public function populateDbToDto(array $item): ColorDTO
    {
        $colorDTO = new ColorDTO();
        $colorDTO->setId($item['color_id']);
        $colorDTO->setName($item['color_name']);
        $colorDTO->setCode($item['color_code']);
        $colorDTO->setCreatedAt(DateTools::stringToDateTimeConverter($item['color_created_at']));
        $colorDTO->setUpdatedAt(DateTools::stringToDateTimeConverter($item['color_updated_at']));
        return $colorDTO;
    }
}