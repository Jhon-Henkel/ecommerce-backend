<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\BrandBO;
use src\DAO\BrandDAO;
use src\DTO\BrandDTO;
use src\Enums\ApiResponseMessageEnum;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;

class BrandController
{
    public function postApi(\stdClass $brand)
    {
        $brandBO = new BrandBO();
        $brandDTO = new BrandDTO();
        $brandDAO = new BrandDAO();
        $brandBO->validatePostParamsApi(FieldsEnum::getValidateFieldsForBrandPost(), $brand);
        $brandToInsert = $brandDTO->populateStdForDto($brand);
        if ($brandDAO->insert($brandToInsert)) {
            Response::Render(HttpStatusCodeEnum::HTTP_CREATED, ApiResponseMessageEnum::CREATED_SUCCESS);
        }
        Response::Render(HttpStatusCodeEnum::HTTP_DAB_REQUEST, ApiResponseMessageEnum::REGISTER_NOT_INSERTED);
    }
}