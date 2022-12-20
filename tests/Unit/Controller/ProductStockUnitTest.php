<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\ProductStockBO;
use src\Controllers\ProductStockController;
use src\Factory\ProductStockDtoFactory;

class ProductStockUnitTest extends TestCase
{
    public function testCallProductStockController()
    {
        $controller = new ProductStockController();
        $this->assertInstanceOf(ProductStockBO::class, $controller->bo);
        $this->assertInstanceOf(ProductStockDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}