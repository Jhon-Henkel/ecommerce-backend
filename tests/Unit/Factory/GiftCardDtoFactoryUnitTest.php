<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\GiftCardDTO;
use src\Factory\GiftCardDtoFactory;
use stdClass;
use tests\Traits\GiftCardTraits;

class GiftCardDtoFactoryUnitTest extends TestCase
{
    use GiftCardTraits;

    public GiftCardDtoFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new GiftCardDtoFactory();
    }

    public function testFactory()
    {
        $item = $this->factory->factory($this->makeStdGiftCardTest1445());
        $this->assertInstanceOf(GiftCardDTO::class, $item);
        $this->assertEquals(1234, $item->getId());
        $this->assertEquals('CUPOM100', $item->getCode());
        $this->assertEquals(1, $item->getDiscountType());
        $this->assertEquals(1, $item->getStatus());
        $this->assertEquals(10.45, $item->getDiscount());
        $this->assertEquals(99, $item->getMaxUsages());
    }

    public function testMakePublic()
    {
        $item = $this->factory->makePublic($this->makeDtoGiftCardTest1445());
        $this->assertInstanceOf(stdClass::class, $item);
        $this->assertEquals(1234, $item->id);
        $this->assertEquals('CUPOM100', $item->code);
        $this->assertEquals(1, $item->discountType);
        $this->assertEquals(1, $item->status);
        $this->assertEquals(10.45, $item->discount);
        $this->assertEquals(99, $item->maxUsages);
    }

    public function testPopulateDbToDto()
    {
        $item = $this->factory->populateDbToDto($this->makeDbGiftCardTest1445());
        $this->assertInstanceOf(GiftCardDTO::class, $item);
        $this->assertEquals(1234, $item->getId());
        $this->assertEquals('CUPOM100', $item->getCode());
        $this->assertEquals(1, $item->getDiscountType());
        $this->assertEquals(1, $item->getStatus());
        $this->assertEquals(10.45, $item->getDiscount());
        $this->assertEquals(99, $item->getMaxUsages());
        $this->assertEquals(1, $item->getUsages());
    }
}