<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\BrandBO;
use src\DAO\BrandDAO;
use src\DTO\BrandDTO;
use src\Enums\ApiResponseMessageEnum;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\BrandDtoFactory;
use src\Tools\RequestTools;

class BrandController
{
    public function postApi(\stdClass $brand)
    {
        $brandBO = new BrandBO();
        $brandDAO = new BrandDAO();
        $brandBO->validatePostParamsApi(FieldsEnum::getValidateFields(), $brand);
        $brandToInsert = BrandDtoFactory::factory($brand);
        $brandDAO->insert($brandToInsert);
        $inserted = $brandBO->FindLastInserted();
        Response::Render(HttpStatusCodeEnum::HTTP_CREATED, BrandDtoFactory::makePublic($inserted));
    }

    public function putApi(\stdClass $brand)
    {
        $brandBO = new BrandBO();
        $brandDAO = new BrandDAO();
        $brand->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $brandBO->validatePutParamsApi(FieldsEnum::getValidateFields(), $brand);
        $brandToUpdate = BrandDtoFactory::factory($brand);
        $brandDAO->update($brandToUpdate);
        Response::Render(HttpStatusCodeEnum::HTTP_OK, BrandDtoFactory::makePublic($brandToUpdate));
    }

    public function getByCode(string $code)
    {
        $brandDAO = new BrandDAO();
        $brand = $brandDAO->findByCode($code);
        if ($brand){
            Response::Render(HttpStatusCodeEnum::HTTP_OK, $brand);
        }
        Response::RenderNotFound();
    }
}