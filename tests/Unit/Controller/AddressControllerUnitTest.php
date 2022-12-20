<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\AddressBO;
use src\Controllers\AddressController;
use src\Factory\AddressDtoFactory;

class AddressControllerUnitTest extends TestCase
{
    public function testCallAddressController()
    {
        $controller = new AddressController();
        $this->assertInstanceOf(AddressBO::class, $controller->bo);
        $this->assertInstanceOf(AddressDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}