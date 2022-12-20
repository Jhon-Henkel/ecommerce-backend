<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\BrandBO;
use src\Controllers\BrandController;
use src\Factory\BrandDtoFactory;

class BrandControllerUnitTest extends TestCase
{
    public function testCallBrandController()
    {
        $controller = new BrandController();
        $this->assertInstanceOf(BrandBO::class, $controller->bo);
        $this->assertInstanceOf(BrandDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}