<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\ProductBO;
use src\DAO\ProductDAO;
use src\Factory\ProductDtoFactory;

class ProductBoUnitTest extends TestCase
{
    public function testCallProductBo()
    {
        $bo = new ProductBO();
        $this->assertInstanceOf(ProductDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(ProductDAO::class, $bo->dao);
    }
}