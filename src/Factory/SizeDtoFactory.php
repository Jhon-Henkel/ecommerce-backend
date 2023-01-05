<?php

namespace src\Factory;

use Exception;
use src\DTO\SizeDTO;
use src\Tools\DateTools;

class SizeDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): SizeDTO
    {
        $sizeFactored = new SizeDTO();
        $sizeFactored->setCode($item->code);
        $sizeFactored->setName($item->name);
        $sizeFactored->setId($item->id ?? null);
        $sizeFactored->setCreatedAt($item->createdAt ?? null);
        $sizeFactored->setUpdatedAt($item->updatedAt ?? null);
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
        $sizePublic->createdAt = $item->getCreatedAt()
            ? DateTools::dateTimeToStringConverter($item->getCreatedAt())
            : null;
        $sizePublic->updatedAt = $item->getUpdatedAt()
            ? DateTools::dateTimeToStringConverter($item->getUpdatedAt())
            : null;
        return $sizePublic;
    }

    /**
     * @throws Exception
     */
    public function populateDbToDto(array $item): SizeDTO
    {
        $sizeDTO = new SizeDTO();
        $sizeDTO->setId($item['size_id']);
        $sizeDTO->setName($item['size_name']);
        $sizeDTO->setCode($item['size_code']);
        $sizeDTO->setCreatedAt(DateTools::stringToDateTimeConverter($item['size_created_at']));
        $sizeDTO->setUpdatedAt(
            $item['size_updated_at']
                ? DateTools::stringToDateTimeConverter($item['size_updated_at'])
                : null
        );
        return $sizeDTO;
    }
}