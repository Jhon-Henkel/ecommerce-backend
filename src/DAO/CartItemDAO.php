<?php

namespace src\DAO;

use src\Database;
use src\DTO\CartItemDTO;

class CartItemDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        return 'cart_item_cart_id, cart_item_stock_id, cart_item_quantity';
    }

    public function getParamsStringToInsert(): string
    {
        return ':cartId, :stockId, :quantity';
    }

    /**
     * @param CartItemDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'cartId' => $item->getCartId(),
            'stockId' => $item->getStockId(),
            'quantity' => $item->getQuantity()
        );
    }

    public function getUpdateSting(): string
    {
        return 'cart_item_cart_id = :cartId, cart_item_stock_id = :stockId, cart_item_quantity = :quantity';
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'cart_item_id = :id';
    }

    /**
     * @param CartItemDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
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

    public function countByColumnValueWithCartId(string $field, string $value, int $cartId): int
    {
        $query = "SELECT * FROM " . $this->table . " WHERE " . $this->table;
        $query .= "_" . $field . " = :value AND " . $this->table . "_cart_id = :cartId";
        $params = array('value' => $value, 'cartId' => $cartId);
        return $this->database->selectCount($query, $params);
    }
}