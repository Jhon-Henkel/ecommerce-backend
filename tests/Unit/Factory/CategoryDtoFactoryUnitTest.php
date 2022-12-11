<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\CategoryDTO;
use src\Factory\CategoryDtoFactory;

class CategoryDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdCategory;
    public CategoryDTO $dtoCategory;
    public array $dbCategory;
    public CategoryDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdCategory = $this->makeStdCategory();
        $this->dtoCategory = $this->makeDtoCategory();
        $this->dbCategory = $this->makeArrayCategoryDb();
        $this->factory = new CategoryDtoFactory();
    }

    public function testMakePublic()
    {
        $publicCategory = $this->factory->makePublic($this->dtoCategory);
        $this->assertInstanceOf(\stdClass::class, $publicCategory);
        $this->assertEquals(963, $publicCategory->id);
        $this->assertEquals('unit test dto category', $publicCategory->name);
        $this->assertEquals('unit-test-dto-category', $publicCategory->code);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdCategory);
        $this->assertInstanceOf(CategoryDTO::class, $factored);
        $this->assertEquals(963, $factored->getId());
        $this->assertEquals('unit test std category', $factored->getName());
        $this->assertEquals('unit-test-std-category', $factored->getCode());
    }

    public function testPopulateDbToDto()
    {
        $category = $this->factory->populateDbToDto($this->dbCategory);
        $this->assertInstanceOf(CategoryDTO::class, $category);
        $this->assertEquals(963, $category->getId());
        $this->assertEquals('Category Test', $category->getName());
        $this->assertEquals('category-test', $category->getCode());
    }

    public function makeStdCategory(): \stdClass
    {
        $category = new \stdClass();
        $category->id = 963;
        $category->name = 'unit test std category';
        $category->code = 'unit-test-std-category';
        $category->fatherId = 5;
        return $category;
    }

    public function makeDtoCategory(): CategoryDTO
    {
        $category = new CategoryDTO();
        $category->setId(963);
        $category->setName('unit test dto category');
        $category->setCode('unit-test-dto-category');
        $category->setFatherId(5);
        return $category;
    }

    public function makeArrayCategoryDb(): array
    {
        $item = array();
        $item['category_id'] = 963;
        $item['category_name'] = 'Category Test';
        $item['category_code'] = 'category-test';
        $item['category_father_id'] = 5;
        return $item;
    }
}
