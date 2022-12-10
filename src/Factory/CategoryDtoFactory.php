<?php

namespace src\Factory;

use src\DTO\CategoryDTO;

class CategoryDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $category): CategoryDTO
    {
        $categoryFactored = new CategoryDTO();
        $categoryFactored->setFatherId($category->fatherId ?? null);
        $categoryFactored->setCode($category->code);
        $categoryFactored->setName($category->name);
        $categoryFactored->setId($category->id ?? null);
        return $categoryFactored;
    }

    public function makePublic(CategoryDTO $category): \stdClass
    {
        $categoryPublic = new \stdClass();
        $categoryPublic->id = $category->getId();
        $categoryPublic->code = $category->getCode();
        $categoryPublic->name = $category->getName();
        $categoryPublic->fatherId = $category->getFatherId() ?? null;
        return $categoryPublic;
    }

    public function populateDbToDto(array $category): CategoryDTO
    {
        $categoryDTO = new CategoryDTO();
        $categoryDTO->setId($category['category_id']);
        $categoryDTO->setName($category['category_name']);
        $categoryDTO->setCode($category['category_code']);
        $categoryDTO->setFatherId($category['category_father_id']);
        return $categoryDTO;
    }
}