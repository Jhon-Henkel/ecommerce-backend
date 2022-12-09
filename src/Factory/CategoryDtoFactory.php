<?php

namespace src\Factory;

use src\DTO\CategoryDTO;

class CategoryDtoFactory
{
    public static function factory(\stdClass $category): CategoryDTO
    {
        $categoryFactored = new CategoryDTO();
        $categoryFactored->setFatherId($category->fatherId ?? null);
        $categoryFactored->setCode($category->code);
        $categoryFactored->setName($category->name);
        $categoryFactored->setId($category->id ?? null);
        return $categoryFactored;
    }

    public static function makePublic(CategoryDTO $category): \stdClass
    {
        $categoryPublic = new \stdClass();
        $categoryPublic->id = $category->getId();
        $categoryPublic->code = $category->getCode();
        $categoryPublic->name = $category->getName();
        $categoryPublic->fatherId = $category->getFatherId() ?? null;
        return $categoryPublic;
    }
}