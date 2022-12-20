<?php

namespace tests\Traits;

use src\DTO\GiftCardDTO;

trait GiftCardTraits
{
    public function makeDtoGiftCardTest1445():GiftCardDTO
    {
        $item = new GiftCardDTO();
        $item->setId(1234);
        $item->setCode("CUPOM100");
        $item->setDiscountType(1);
        $item->setStatus(1);
        $item->setDiscount(10.45);
        $item->setMaxUsages(99);
        return $item;
    }
}