<?php

namespace tests\Unit\BO;

use PHPUnit\Framework\TestCase;
use src\BO\CategoryBO;
use src\DAO\CategoryDAO;
use src\Factory\CategoryDtoFactory;
use tests\Traits\CategoryTraits;

class CategoryBoUnitTest extends TestCase
{
    use CategoryTraits;

    public CategoryBO $bo;

    protected function setUp(): void
    {
        $this->bo = new CategoryBO();
    }

    public function testCallCategoryBo()
    {
        $this->assertInstanceOf(CategoryDtoFactory::class, $this->bo->factory);
        $this->assertInstanceOf(CategoryDAO::class, $this->bo->dao);
    }
}