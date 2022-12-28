<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\CartItemBO;
use src\Controllers\CartItemController;
use src\Factory\CartItemDtoFactory;

class CartItemControllerUnitTest extends TestCase
{
    public function testCallCartController()
    {
        $controller = new CartItemController();
        $this->assertInstanceOf(CartItemBO::class, $controller->bo);
        $this->assertInstanceOf(CartItemDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}