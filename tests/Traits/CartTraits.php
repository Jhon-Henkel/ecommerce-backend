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
}