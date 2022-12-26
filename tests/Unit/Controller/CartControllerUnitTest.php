<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\CartBO;
use src\Controllers\CartController;
use src\Factory\CartDtoFactory;

class CartControllerUnitTest extends TestCase
{
    public function testCallCartController()
    {
        $controller = new CartController();
        $this->assertInstanceOf(CartBO::class, $controller->bo);
        $this->assertInstanceOf(CartDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}