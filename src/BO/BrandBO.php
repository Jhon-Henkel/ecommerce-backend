<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\BrandDAO;
use src\Enums\FieldsEnum;
use src\Tools\ValidateTools;
use stdClass;

class BrandBO
{
    /**
     * @param array $paramsFields
     * @param stdClass $brand
     * @return void
     */
    public function validatePostParamsApi(array $paramsFields, stdClass $brand)
    {
        $brandDAO = new BrandDAO();
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$brand)) {
            Response::RenderRequiredAttributesMissing();
        }
        if ($brandDAO->findByCode($brand->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($brandDAO->findByName($brand->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }
}