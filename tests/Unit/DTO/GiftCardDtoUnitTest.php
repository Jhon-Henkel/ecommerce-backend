<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\GiftCardDTO;
use src\Enums\StatusEnum;
use src\Tools\DateTools;

class GiftCardDtoUnitTest extends TestCase
{
    public object $giftCart;

    protected function setUp(): void
    {
        $this->giftCart = new GiftCardDTO();
    }

    public function testGettersAndSettersGiftCard()
    {
        $this->giftCart->setId(745);
        $this->giftCart->setMaxUsages(999);
        $this->giftCart->setDiscount(99.55);
        $this->giftCart->setStatus(StatusEnum::ACTIVE);
        $this->giftCart->setDiscountType(1);
        $this->giftCart->setCode('XDA-80%');
        $this->giftCart->setUsages(0);
        $this->giftCart->setCreatedAt(new \DateTime('2022-10-01'));
        $this->giftCart->setUpdatedAt(new \DateTime('2022-11-15'));
        $this->assertEquals(745, $this->giftCart->getId());
        $this->assertEquals(999, $this->giftCart->getMaxUsages());
        $this->assertEquals(99.55, $this->giftCart->getDiscount());
        $this->assertEquals(StatusEnum::ACTIVE, $this->giftCart->getStatus());
        $this->assertEquals(1, $this->giftCart->getDiscountType());
        $this->assertEquals('XDA-80%', $this->giftCart->getCode());
        $this->assertEquals(0, $this->giftCart->getUsages());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($this->giftCart->getCreatedAt()));
        $this->assertEquals('2022-11-15', DateTools::dateTimeToStringConverter($this->giftCart->getUpdatedAt()));
    }
}