<?php

namespace tests\Traits;

use src\DTO\CategoryDTO;
use stdClass;

trait CategoryTraits
{
    public function makeDtoCategoryTest105(): CategoryDTO
    {
        $category = new CategoryDTO();
        $category->setId(105);
        $category->setName('Category Test');
        $category->setCode('category-test-105');
        $category->setFatherId(10);
        return $category;
    }

    public function makeStdCategoryTest105(): stdClass
    {
        $category = new stdClass();
        $category->id = 105;
        $category->name = 'Category Test 105';
        $category->code = 'category-test-105';
        return $category;
    }

    public function makeStdCategoryTest106(): stdClass
    {
        $category = new stdClass();
        $category->id = 106;
        $category->name = 'Category Test 106';
        $category->code = 'category-test-106';
        return $category;
    }

}