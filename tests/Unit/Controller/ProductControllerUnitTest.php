<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\ProductBO;
use src\Controllers\ProductController;
use src\Factory\ProductDtoFactory;

class ProductControllerUnitTest extends TestCase
{
    public function testCallProductController()
    {
        $controller = new ProductController();
        $this->assertInstanceOf(ProductBO::class, $controller->bo);
        $this->assertInstanceOf(ProductDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}