<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CategoryBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\CategoryDtoFactory;

class CategoryController
{
    public function apiPost(\stdClass $category)
    {
        $categoryBO = new CategoryBO();
        $categoryBO->validatePostParamsApi(FieldsEnum::getValidateCategoryFields(), $category);
        $categoryToInsert = CategoryDtoFactory::factory($category);
        $categoryBO->insert($categoryToInsert);
        $inserted = $categoryBO->findLastInserted();
        Response::Render(HttpStatusCodeEnum::HTTP_CREATED, CategoryDtoFactory::makePublic($inserted));
    }
}