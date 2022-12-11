<?php

namespace src\DAO;

use src\DTO\ColorDTO;

class ColorDAO extends BasicDAO
{

    function getColumnsToInsert(): string
    {
        return 'color_code, color_name';
    }

    function getParamsStringToInsert(): string
    {
        return ':code, :name';
    }

    /**
     * @param ColorDTO $item
     * @return array
     */
    function getParamsArrayToInsert($item): array
    {
        return array('code' => $item->getCode(), 'name' => $item->getName());
    }

    function getUpdateSting(): string
    {
        return 'color_code = :code, color_name = :name';
    }

    function getWhereClausuleToUpdate(): string
    {
        return 'color_id = :id';
    }

    /**
     * @param ColorDTO $item
     * @return array
     */
    function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}