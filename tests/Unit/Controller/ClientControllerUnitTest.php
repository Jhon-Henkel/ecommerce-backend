<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\ClientBO;
use src\Controllers\ClientController;
use src\Factory\ClientDtoFactory;

class ClientControllerUnitTest extends TestCase
{
    public function testCallClientController()
    {
        $controller = new ClientController();
        $this->assertInstanceOf(ClientBO::class, $controller->bo);
        $this->assertInstanceOf(ClientDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}