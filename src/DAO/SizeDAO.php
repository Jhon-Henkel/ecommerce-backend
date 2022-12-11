<?php

namespace src\DAO;

use src\DTO\SizeDTO;

class SizeDAO extends BasicDAO
{

    function getColumnsToInsert(): string
    {
        return 'size_code, size_name';
    }

    function getParamsStringToInsert(): string
    {
        return ':code, :name';
    }

    /**
     * @param SizeDTO $item
     * @return array
     */
    function getParamsArrayToInsert($item): array
    {
        return array('code' => $item->getCode(), 'name' => $item->getName());
    }

    function getUpdateSting(): string
    {
        return 'size_code = :code, size_name = :name';
    }

    function getWhereClausuleToUpdate(): string
    {
        return 'size_id = :id';
    }

    /**
     * @param SizeDTO $item
     * @return array
     */
    function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}