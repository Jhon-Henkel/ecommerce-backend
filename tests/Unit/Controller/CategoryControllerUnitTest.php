<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\CategoryBO;
use src\Controllers\CategoryController;
use src\Factory\CategoryDtoFactory;

class CategoryControllerUnitTest extends TestCase
{
    public function testCallCategoryController()
    {
        $controller = new CategoryController();
        $this->assertInstanceOf(CategoryBO::class, $controller->bo);
        $this->assertInstanceOf(CategoryDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}