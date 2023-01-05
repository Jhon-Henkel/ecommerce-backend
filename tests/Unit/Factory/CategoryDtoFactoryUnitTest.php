<?php

namespace tests\Unit\Factory;

use DateTime;
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

    public function testMakePublicWithDates()
    {
        $item = $this->dtoCategory;
        $item->setCreatedAt(new DateTime('2022-01-15'));
        $item->setUpdatedAt(new DateTime('2022-10-01'));
        $publicCategory = $this->factory->makePublic($item);
        $this->assertInstanceOf(\stdClass::class, $publicCategory);
        $this->assertEquals(963, $publicCategory->id);
        $this->assertEquals('unit test dto category', $publicCategory->name);
        $this->assertEquals('unit-test-dto-category', $publicCategory->code);
        $this->assertStringContainsString('2022-01-15', $publicCategory->createdAt);
        $this->assertStringContainsString('2022-10-01', $publicCategory->updatedAt);
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

    public function testPopulateDbToDtoWithDate()
    {
        $item = $this->dbCategory;
        $item['category_created_at'] = '2022-01-15';
        $item['category_updated_at'] = '2022-10-01';
        $category = $this->factory->populateDbToDto($item);
        $this->assertInstanceOf(CategoryDTO::class, $category);
        $this->assertEquals(963, $category->getId());
        $this->assertEquals('Category Test', $category->getName());
        $this->assertEquals('category-test', $category->getCode());
        $this->assertInstanceOf(DateTime::class, $category->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $category->getUpdatedAt());
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
        $category->setCreatedAt(null);
        $category->setUpdatedAt(null);
        return $category;
    }

    public function makeArrayCategoryDb(): array
    {
        $item = array();
        $item['category_id'] = 963;
        $item['category_name'] = 'Category Test';
        $item['category_code'] = 'category-test';
        $item['category_father_id'] = 5;
        $item['category_created_at'] = null;
        $item['category_updated_at'] = null;
        return $item;
    }
}
