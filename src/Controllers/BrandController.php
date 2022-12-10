<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\BrandBO;
use src\DAO\BrandDAO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\BrandDtoFactory;
use src\Tools\RequestTools;

class BrandController
{
    public function apiPost(\stdClass $brand)
    {
        $brandBO = new BrandBO();
        $brandDAO = new BrandDAO();
        $brandBO->validatePostParamsApi(FieldsEnum::getBasicValidateFields(), $brand);
        $brandToInsert = BrandDtoFactory::factory($brand);
        $brandDAO->insert($brandToInsert);
        $inserted = $brandBO->findLastInserted();
        Response::Render(HttpStatusCodeEnum::HTTP_CREATED, BrandDtoFactory::makePublic($inserted));
    }

    public function apiPut(\stdClass $brand)
    {
        $brandBO = new BrandBO();
        $brandDAO = new BrandDAO();
        $brand->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $brandBO->validatePutParamsApi(FieldsEnum::getBasicValidateFields(), $brand);
        $brandToUpdate = BrandDtoFactory::factory($brand);
        $brandDAO->update($brandToUpdate);
        Response::Render(HttpStatusCodeEnum::HTTP_OK, BrandDtoFactory::makePublic($brandToUpdate));
    }

    public function apiGet(int $id)
    {
        $brandBO = new BrandBO();
        $brand = $brandBO->findById($id);
        if ($brand){
            Response::Render(HttpStatusCodeEnum::HTTP_OK, BrandDtoFactory::makePublic($brand));
        }
        Response::RenderNotFound();
    }

    public function apiIndex()
    {
        $brandBO = new BrandBO();
        $brands = $brandBO->findAll();
        Response::Render(HttpStatusCodeEnum::HTTP_OK, $brands);
    }

    public function apiDelete(int $id)
    {
        $brandBO = new BrandBO();
        $brandBO->deleteById($id);
        Response::Render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
    }
}