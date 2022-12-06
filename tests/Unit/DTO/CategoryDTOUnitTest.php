<?php

namespace Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\CategoryDTO;

class CategoryDTOUnitTest extends TestCase
{
    public object $category;

    protected function setUp(): void
    {
        $this->category = new CategoryDTO();
    }

    public function testGetterAndSettersCategory()
    {
        $this->category->setId(655);
        $this->category->setCode('category-655');
        $this->category->setName('category test');
        $this->category->setFatherId(654);
        $this->assertEquals(655, $this->category->getId());
        $this->assertEquals('category-655', $this->category->getCode());
        $this->assertEquals('category test', $this->category->getName());
        $this->assertEquals(654, $this->category->getFatherId());
    }
}