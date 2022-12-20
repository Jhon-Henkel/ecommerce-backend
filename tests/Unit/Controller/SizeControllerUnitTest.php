<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\SizeBO;
use src\Controllers\SizeController;
use src\Factory\SizeDtoFactory;

class SizeControllerUnitTest extends TestCase
{
    public function testCallSizeController()
    {
        $controller = new SizeController();
        $this->assertInstanceOf(SizeBO::class, $controller->bo);
        $this->assertInstanceOf(SizeDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}