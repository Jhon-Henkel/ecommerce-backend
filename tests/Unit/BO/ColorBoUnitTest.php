<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\ColorBO;
use src\DAO\ColorDAO;
use src\Factory\ColorDtoFactory;

class ColorBoUnitTest extends TestCase
{
    public function testCallColorBo()
    {
        $bo = new ColorBO();
        $this->assertInstanceOf(ColorDtoFactory::class, $bo->factory);
        $this->assertInstanceOf(ColorDAO::class, $bo->dao);
    }
}