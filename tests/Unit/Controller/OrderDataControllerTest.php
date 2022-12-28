<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\OrderDataBO;
use src\Controllers\OrderDataController;
use src\Factory\OrderDataDtoFactory;

class OrderDataControllerTest extends TestCase
{
    public function testCallCartController()
    {
        $controller = new OrderDataController();
        $this->assertInstanceOf(OrderDataBO::class, $controller->bo);
        $this->assertInstanceOf(OrderDataDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}