<?php

namespace src\DAO;

use src\DTO\BrandDTO;

class BrandDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        return 'brand_code, brand_name';
    }

    public function getParamsStringToInsert(): string
    {
        return ':code, :name';
    }

    /**
     * @param BrandDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array('code' => $item->getCode(), 'name' => $item->getName());
    }

    public function getUpdateSting(): string
    {
        return 'brand_code = :code, brand_name = :name';
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'brand_id = :id';
    }

    /**
     * @param BrandDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}