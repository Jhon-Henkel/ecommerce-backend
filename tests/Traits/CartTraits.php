<?php

namespace tests\Traits;

use src\Database;
use src\DTO\CartDTO;

trait CartTraits
{
    use ClientTraits;

    public function makeDtoCartTest852(): CartDTO
    {
        $cart = new CartDTO();
        $cart->setClientId(777);
        $cart->setId(852);
        $cart->setOrderDone(1);
        $cart->setGiftCardId(987);
        $cart->setHash('098f6bcd4621d373cade4e832627b4f6');
        $cart->setCreatedAt(new \DateTime('2022-10-01'));
        $cart->setUpdatedAt(new \DateTime('2022-11-10'));
        return $cart;
    }

    public function makeStdCartTest852(): \stdClass
    {
        $cart = new \stdClass();
        $cart->clientId = 741;
        $cart->id = 852;
        $cart->orderDone = 1;
        $cart->giftCardId = 987;
        $cart->hash = '098f6bcd4621d373cade4e832627b4f6';
        $cart->createdAt = new \DateTime('2022-10-01');
        $cart->updatedAt = new \DateTime('2022-11-10');
        return $cart;
    }

    public function makeDbCartTest852(): array
    {
        return array(
            'cart_client_id' => 741,
            'cart_id' => 852,
            'cart_order_done' => 1,
            'cart_gift_card_id' => 987,
            'cart_hash' => '098f6bcd4621d373cade4e832627b4f6',
            'cart_created_at' => '2022-10-01',
            'cart_updated_at' => '2022-11-10'
        );
    }

    public function insertOnDbCart852(): void
    {
        $this->insertOnDbClient741();
        $db = new Database();
        $query = "INSERT INTO cart (cart_id, cart_client_id, cart_hash, cart_gift_card_id, cart_order_done) VALUES (852, 741, '098f6bcd4621d373cade4e832627b4f6', null, 0)";
        $db->insert($query);
    }

    public function deleteOnDbCart852(): void
    {
        $db = new Database();
        $db->delete("DELETE FROM cart WHERE cart_id = 852");
        $this->deleteOnDbClient741();
    }
}