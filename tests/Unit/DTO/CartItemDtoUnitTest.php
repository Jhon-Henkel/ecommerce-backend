<?php

namespace tests\Unit\DTO;

use Exception;
use PHPUnit\Framework\TestCase;
use src\DTO\CartItemDTO;
use src\Tools\DateTools;

class CartItemDtoUnitTest extends TestCase
{
    public object $cartItem;

    protected function setUp(): void
    {
        $this->cartItem = new CartItemDTO();
    }

    /**
     * @throws Exception
     */
    public function testCartItemDto()
    {
        $this->cartItem->setId(775);
        $this->cartItem->setQuantity(12);
        $this->cartItem->setCartId(852);
        $this->cartItem->setStockId(74);
        $this->cartItem->setCreatedAt(DateTools::stringToDateTimeConverter('2022-10-01'));
        $this->cartItem->setUpdatedAt(null);
        $this->assertEquals(775, $this->cartItem->getId());
        $this->assertEquals(12, $this->cartItem->getQuantity());
        $this->assertEquals(852, $this->cartItem->getCartId());
        $this->assertEquals(74, $this->cartItem->getStockId());
        $date = DateTools::dateTimeToStringConverter($this->cartItem->getCreatedAt());
        $this->assertStringContainsString('2022-10-01', $date);
        $this->assertNull($this->cartItem->getUpdatedAt());
    }
}