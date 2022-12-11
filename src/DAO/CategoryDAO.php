<?php

namespace src\DAO;

use src\DTO\CategoryDTO;

class CategoryDAO extends BasicDAO
{

    function getColumnsToInsert(): string
    {
        return 'category_code, category_name, category_father_id';
    }

    function getParamsStringToInsert(): string
    {
        return ':code, :name, :fatherId';
    }

    /**
     * @param CategoryDTO $item
     * @return array
     */
    function getParamsArrayToInsert($item): array
    {
        return array(
            'code' => $item->getCode(),
            'name' => $item->getName(),
            'fatherId' => $item->getFatherId()
        );
    }

    function getUpdateSting(): string
    {
        return 'category_code = :code, category_name = :name, category_father_id = :fatherId';
    }

    function getWhereClausuleToUpdate(): string
    {
        return 'category_id = :id';
    }

    /**
     * @param CategoryDTO $item
     * @return array
     */
    function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}