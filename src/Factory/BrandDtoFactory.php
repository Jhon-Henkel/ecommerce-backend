<?php

namespace src\Factory;

use Exception;
use src\DTO\BrandDTO;
use src\Tools\DateTools;
use stdClass;

class BrandDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): BrandDTO
    {
        $brandFactored = new BrandDTO();
        $brandFactored->setId($item->id ?? null);
        $brandFactored->setName($item->name);
        $brandFactored->setCode($item->code);
        $brandFactored->setCreatedAt($item->createdAt ?? null);
        $brandFactored->setUpdatedAt($item->updatedAt ?? null);
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
        $brandPublic->createdAt = $item->getCreatedAt() ? DateTools::dateTimeToStringConverter($item->getCreatedAt()) : null;
        $brandPublic->updatedAt = $item->getUpdatedAt() ? DateTools::dateTimeToStringConverter($item->getUpdatedAt()) : null;
        return $brandPublic;
    }

    /**
     * @throws Exception
     */
    public function populateDbToDto(array $item): BrandDTO
    {
        $brandDTO = new BrandDTO();
        $brandDTO->setId($item['brand_id']);
        $brandDTO->setName($item['brand_name']);
        $brandDTO->setCode($item['brand_code']);
        $brandDTO->setCreatedAt(DateTools::stringToDateTimeConverter($item['brand_created_at']));
        $brandDTO->setUpdatedAt(
            $item['brand_updated_at']
                ? DateTools::stringToDateTimeConverter($item['brand_updated_at'])
                : null
        );
        return $brandDTO;
    }
}