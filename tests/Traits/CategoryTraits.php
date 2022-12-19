<?php

namespace tests\Traits;

use src\DTO\CategoryDTO;

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
}