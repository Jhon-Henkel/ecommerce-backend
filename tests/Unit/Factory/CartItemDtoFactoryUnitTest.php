<?php

namespace tests\Unit\Factory;

use Exception;
use PHPUnit\Framework\TestCase;
use src\DTO\CartItemDTO;
use src\Factory\CartItemDtoFactory;
use stdClass;
use tests\Traits\CartItemTraits;

class CartItemDtoFactoryUnitTest extends TestCase
{
    use CartItemTraits;

    public stdClass $item;
    public CartItemDtoFactory $factory;

    protected function setUp(): void
    {
        $this->item = $this->makeStdCartItem775();
        $this->factory = new CartItemDtoFactory();
    }

    public function testFactory()
    {
        $item = $this->factory->factory($this->item);
        $this->assertInstanceOf(CartItemDTO::class, $item);
        $this->assertEquals(775, $item->getId());
        $this->assertEquals(12, $item->getQuantity());
        $this->assertEquals(852, $item->getCartId());
        $this->assertEquals(74, $item->getStockId());
    }

    /**
     * @throws Exception
     */
    public function testFactoryItemPut()
    {
        $stdItem = $this->item;
        $stdItem->quantity = 150;
        $stdItem->cartId = 9000;
        $stdItem->id = 654788;
        $item = $this->factory->factoryItemPut($stdItem, $this->makeDtoCartItem775());
        $this->assertEquals(775, $item->getId());
        $this->assertEquals(150, $item->getQuantity());
        $this->assertEquals(852, $item->getCartId());
        $this->assertEquals(74, $item->getStockId());
    }
}