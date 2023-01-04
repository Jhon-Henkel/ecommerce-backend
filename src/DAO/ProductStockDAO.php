<?php

namespace src\DAO;

use src\DTO\ProductStockDTO;

class ProductStockDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        $columns = 'product_stock_code, product_stock_name, product_stock_quantity, product_stock_color_id,';
        $columns .= ' product_stock_size_id, product_stock_brand_id, product_stock_product_id, product_stock_price,';
        $columns .= 'product_stock_width, product_stock_height, product_stock_length, product_stock_gross_weight';
        return $columns;
    }

    public function getParamsStringToInsert(): string
    {
        $params = ':code, :name, :quantity, :color_id, :size_id, :brand_id,';
        $params .= ' :product_id, :price, :width, :height, :length, :gross_weight';
        return $params;
    }

    /**
     * @param ProductStockDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'code' => $item->getCode(),
            'name' => $item->getName(),
            'quantity' => $item->getQuantity(),
            'color_id' => $item->getColorId(),
            'size_id' => $item->getSizeId(),
            'brand_id' => $item->getBandId(),
            'product_id' => $item->getProductId(),
            'price' => $item->getPrice(),
            'width' => $item->getWidth(),
            'height' => $item->getHeight(),
            'length' => $item->getLength(),
            'gross_weight' => $item->getGrossWeight()
        );
    }

    public function getUpdateSting(): string
    {
        $updateString = 'product_stock_code = :code, product_stock_name = :name,';
        $updateString .= ' product_stock_quantity = :quantity, product_stock_color_id = :color_id,';
        $updateString .= ' product_stock_size_id = :size_id, product_stock_brand_id = :brand_id,';
        $updateString .= ' product_stock_product_id = :product_id, product_stock_price = :price,';
        $updateString .= ' product_stock_width = :width, product_stock_height = :height,';
        $updateString .= ' product_stock_length = :length, product_stock_gross_weight = :gross_weight';
        return $updateString;
    }

    public function findByProductId(int $id): array
    {
        $query = 'SELECT * FROM product_stock WHERE product_stock_product_id = :id';
        return $this->database->select($query, array('id' => $id));
    }

    public function deleteAllByProductId(int $id): void
    {
        $query = "DELETE FROM product_stock WHERE product_stock_product_id = :id";
        $this->database->delete($query, array('id' => $id));
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'product_stock_id = :id';
    }

    /**
     * @param ProductStockDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}