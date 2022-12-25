<?php

namespace src\DAO;

use src\Database;

class CartItemDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        // TODO: Implement getColumnsToInsert() method.
    }

    public function getParamsStringToInsert(): string
    {
        // TODO: Implement getParamsStringToInsert() method.
    }

    public function getParamsArrayToInsert($item): array
    {
        // TODO: Implement getParamsArrayToInsert() method.
    }

    public function getUpdateSting(): string
    {
        // TODO: Implement getUpdateSting() method.
    }

    public function getWhereClausuleToUpdate(): string
    {
        // TODO: Implement getWhereClausuleToUpdate() method.
    }

    public function getParamsArrayToUpdate($item): array
    {
        // TODO: Implement getParamsArrayToUpdate() method.
    }

    public function findAllByCartId(int $cartId): null|array
    {
        $db = new Database();
        $query = "SELECT * FROM cart_item WHERE cart_item_cart_id = :id";
        return $db->select($query, array('id' => $cartId));
    }

    public function deleteByCartId(int $cartId): void
    {
        $db = new Database();
        $query = "DELETE FROM cart_item WHERE cart_item_cart_id = :id";
        $db->delete($query, array('id' => $cartId));
    }
}