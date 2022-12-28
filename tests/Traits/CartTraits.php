<?php

namespace tests\Traits;

use src\DTO\CartDTO;

trait CartTraits
{
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
        $cart->clientId = 777;
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
            'cart_client_id' => 777,
            'cart_id' => 852,
            'cart_order_done' => 1,
            'cart_gift_card_id' => 987,
            'cart_hash' => '098f6bcd4621d373cade4e832627b4f6',
            'cart_created_at' => '2022-10-01',
            'cart_updated_at' => '2022-11-10'
        );
    }
}