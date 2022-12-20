<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\SizeBO;
use src\DAO\SizeDAO;
use src\Factory\SizeDtoFactory;

class SizeBoUnitTest extends TestCase
{
    public function testCallSizeBo()
    {
        $bo = new SizeBO();
        $this->assertInstanceOf(SizeDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(SizeDAO::class, $bo->dao);
    }
}