<?php

namespace src\Factory;

use src\DTO\CategoryDTO;
use src\Tools\DateTools;
use stdClass;

class CategoryDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): CategoryDTO
    {
        $categoryFactored = new CategoryDTO();
        $categoryFactored->setFatherId($item->fatherId ?? null);
        $categoryFactored->setCode($item->code);
        $categoryFactored->setName($item->name);
        $categoryFactored->setId($item->id ?? null);
        $categoryFactored->setCreatedAt($item->createdAt ?? null);
        $categoryFactored->setUpdatedAt($item->updatedAt ?? null);
        return $categoryFactored;
    }

    /**
     * @param CategoryDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $categoryPublic = new stdClass();
        $categoryPublic->id = $item->getId();
        $categoryPublic->code = $item->getCode();
        $categoryPublic->name = $item->getName();
        $categoryPublic->fatherId = $item->getFatherId() ?? null;
        $categoryPublic->createdAt = $item->getCreatedAt()
            ? DateTools::dateTimeToStringConverter($item->getCreatedAt())
            : null;
        $categoryPublic->updatedAt = $item->getUpdatedAt()
            ? DateTools::dateTimeToStringConverter($item->getUpdatedAt())
            : null;
        return $categoryPublic;
    }

    public function populateDbToDto(array $item): CategoryDTO
    {
        $categoryDTO = new CategoryDTO();
        $categoryDTO->setId($item['category_id']);
        $categoryDTO->setName($item['category_name']);
        $categoryDTO->setCode($item['category_code']);
        $categoryDTO->setFatherId($item['category_father_id']);
        $categoryDTO->setCreatedAt(DateTools::stringToDateTimeConverter($item['category_created_at']));
        $categoryDTO->setUpdatedAt(
            $item['category_updated_at']
                ? DateTools::stringToDateTimeConverter($item['category_updated_at'])
                : null
        );
        return $categoryDTO;
    }
}