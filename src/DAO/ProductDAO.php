<?php

namespace src\DAO;

use src\DTO\ProductDTO;

class ProductDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        return 'product_code, product_name, product_url, product_description, product_category_id';
    }

    public function getParamsStringToInsert(): string
    {
        return ':code, :name, :url, :description, :categoryId';
    }

    /**
     * @param ProductDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'code' => $item->getCode(),
            'name' => $item->getName(),
            'url' => $item->getUrl(),
            'description' => $item->getDescription(),
            'categoryId' => $item->getCategoryId()
        );
    }

    public function getUpdateSting(): string
    {
        $updateString = 'product_code = :code, product_name = :name, product_url = :url,';
        $updateString .= ' product_description = :description, product_category_id = :categoryId';
        return $updateString;
    }

    public function getWhereClausuleToUpdate():string
    {
        return 'product_id = :id';
    }

    /**
     * @param ProductDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item):array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}