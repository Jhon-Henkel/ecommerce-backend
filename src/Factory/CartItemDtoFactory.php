<?php

namespace src\Factory;

use src\DTO\CartItemDTO;

class CartItemDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): CartItemDTO
    {
        $cartItem = new CartItemDTO();
        $cartItem->setId($item->id ?? null);
        $cartItem->setQuantity($item->quantity);
        $cartItem->setStockId($item->stockId);
        $cartItem->setCartId($item->cartId);
        return $cartItem;
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
        $cartItem->quantity = $item->getQuantity();
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

    public function factoryItemPut(\stdClass $object, CartItemDTO $item): CartItemDTO
    {
        $item->setQuantity($object->quantity);
        return $item;
    }
}