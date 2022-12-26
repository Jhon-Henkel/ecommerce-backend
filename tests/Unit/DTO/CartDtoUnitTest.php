<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\CartDTO;
use src\Tools\DateTools;
use src\Tools\SecurityTools;

class CartDtoUnitTest extends TestCase
{
    public object $cart;

    protected function setUp(): void
    {
        $this->cart = new CartDTO();
    }

    public function testGettersAndSettersCart()
    {
        $hash = SecurityTools::generateMd5UniqId();
        $this->cart->setClientId(777);
        $this->cart->setId(852);
        $this->cart->setOrderDone(1);
        $this->cart->setGiftCardId(987);
        $this->cart->setHash($hash);
        $this->cart->setCreatedAt(new \DateTime('2022-10-01'));
        $this->cart->setUpdatedAt(new \DateTime('2022-11-10'));
        $this->assertEquals(777, $this->cart->getClientId());
        $this->assertEquals(852, $this->cart->getId());
        $this->assertEquals(1, $this->cart->getOrderDone());
        $this->assertEquals(987, $this->cart->getGiftCardId());
        $this->assertEquals($hash, $this->cart->getHash());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($this->cart->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($this->cart->getUpdatedAt()));
    }
}