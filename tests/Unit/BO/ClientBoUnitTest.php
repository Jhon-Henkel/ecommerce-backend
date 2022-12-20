<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\ClientBO;
use src\DAO\ClientDAO;
use src\Factory\ClientDtoFactory;

class ClientBoUnitTest extends TestCase
{
    public function testCallClientBo()
    {
        $bo = new ClientBO();
        $this->assertInstanceOf(ClientDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(ClientDAO::class, $bo->dao);
    }
}