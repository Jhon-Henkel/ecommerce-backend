<?php

namespace Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\SizeDTO;

class SizeDtoUnitTest extends TestCase
{
    public object $size;

    protected function setUp(): void
    {
        $this->size = new SizeDTO();
    }

    public function testGetterAndSettersSize()
    {
        $this->size->setId(594);
        $this->size->setCode('size-1');
        $this->size->setName('size');
        $this->assertEquals(594, $this->size->getId());
        $this->assertEquals('size-1', $this->size->getCode());
        $this->assertEquals('size', $this->size->getName());
    }
}