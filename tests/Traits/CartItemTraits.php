<?php

namespace tests\Traits;

use Exception;
use src\Database;
use src\DTO\CartItemDTO;
use src\Tools\DateTools;
use stdClass;

trait CartItemTraits
{
    use CartTraits, ProductTraits, ProductStockTrait;

    /**
     * @throws Exception
     */
    public function makeDtoCartItem775(): CartItemDTO
    {
        $item = new CartItemDTO();
        $item->setId(775);
        $item->setQuantity(12);
        $item->setCartId(852);
        $item->setStockId(74);
        $item->setCreatedAt(DateTools::stringToDateTimeConverter('2022-10-01'));
        $item->setUpdatedAt(null);
        return $item;
    }

    /**
     * @throws Exception
     */
    public function makeDtoCartItem776(): CartItemDTO
    {
        $item = new CartItemDTO();
        $item->setId(776);
        $item->setQuantity(10);
        $item->setCartId(852);
        $item->setStockId(75);
        $item->setCreatedAt(DateTools::stringToDateTimeConverter('2022-10-01'));
        $item->setUpdatedAt(null);
        return $item;
    }

    public function makeStdCartItem775(): stdClass
    {
        $item = new stdClass();
        $item->id = 775;
        $item->quantity = 12;
        $item->cartId = 852;
        $item->stockId = 74;
        return $item;
    }

    public function insertOnDbCartItem775And776()
    {
        $this->insertOnDbProductTest145();
        $this->insertOnDbCart852();
        $query775 = "INSERT INTO cart_item (cart_item_id, cart_item_cart_id, cart_item_stock_id, cart_item_quantity) VALUES (775, 852, 74, 12)";
        $query776 = "INSERT INTO cart_item (cart_item_id, cart_item_cart_id, cart_item_stock_id, cart_item_quantity) VALUES (776, 852, 75, 10)";
        $db = new Database();
        $db->insert($query775);
        $db->insert($query776);
    }

    public function deleteOnDbCartItem775And776()
    {
        $db = new Database();
        $db->delete("DELETE FROM cart_item WHERE cart_item_id = 775");
        $db->delete("DELETE FROM cart_item WHERE cart_item_id = 776");
        $this->deleteOnDbCart852();
        $this->deleteOnDbProductTest145();
    }
}