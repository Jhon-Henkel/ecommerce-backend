<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\GiftCardBO;
use src\DAO\GiftCardDAO;
use src\Factory\GiftCardDtoFactory;

class GiftCardBoUnitTest extends TestCase
{
    public function testCallGiftCardBo()
    {
        $bo = new GiftCardBO();
        $this->assertInstanceOf(GiftCardDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(GiftCardDAO::class, $bo->dao);
    }
}