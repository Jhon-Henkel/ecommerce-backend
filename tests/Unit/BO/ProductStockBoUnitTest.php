<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\ProductStockBO;
use src\DAO\ProductStockDAO;
use src\Factory\ProductStockDtoFactory;

class ProductStockBoUnitTest extends TestCase
{
    public function testCallProductStockBo()
    {
        $bo = new ProductStockBO();
        $this->assertInstanceOf(ProductStockDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(ProductStockDAO::class, $bo->dao);
    }
}