<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\ColorBO;
use src\Controllers\ColorController;
use src\Factory\ColorDtoFactory;

class ColorControllerUnitTest extends TestCase
{
    public function testCallColorController()
    {
        $controller = new ColorController();
        $this->assertInstanceOf(ColorBO::class, $controller->bo);
        $this->assertInstanceOf(ColorDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}