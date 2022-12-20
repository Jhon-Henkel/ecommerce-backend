<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\AddressBO;
use src\DAO\AddressDAO;
use src\Factory\AddressDtoFactory;

class AddressBoUnitTest extends TestCase
{
    public function testCallAddressBo()
    {
        $bo = new AddressBO();
        $this->assertInstanceOf(AddressDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(AddressDAO::class, $bo->dao);
    }
}