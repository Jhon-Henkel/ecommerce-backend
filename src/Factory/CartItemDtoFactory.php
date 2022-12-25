<?php

namespace src\Factory;

use src\DTO\CartItemDTO;

class CartItemDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): CartItemDTO
    {
        // TODO: Implement factory() method.
    }

    /**
     * @param CartItemDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        $cartItem = new \stdClass();
        $cartItem->id = $item->getId();
        $cartItem->cartId = $item->getCartId();
        $cartItem->stockId = $item->getStockId();
        $cartItem->quantity = $item->getStockId();
        return $cartItem;
    }

    public function populateDbToDto(array $item): CartItemDTO
    {
        $cartItem = new CartItemDTO();
        $cartItem->setId($item['cart_item_id']);
        $cartItem->setCartId($item['cart_item_cart_id']);
        $cartItem->setStockId($item['cart_item_stock_id']);
        $cartItem->setQuantity($item['cart_item_quantity']);
        return $cartItem;
    }
}