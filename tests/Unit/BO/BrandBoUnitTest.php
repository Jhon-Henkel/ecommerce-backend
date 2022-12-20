<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\BrandBO;
use src\DAO\BrandDAO;
use src\Factory\BrandDtoFactory;

class BrandBoUnitTest extends TestCase
{
    public function testCallBrandBo()
    {
        $bo = new BrandBO();
        $this->assertInstanceOf(BrandDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(BrandDAO::class, $bo->dao);
    }
}