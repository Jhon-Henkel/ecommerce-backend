<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ProductController;
use src\Controllers\BrandController;
use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Enums\RequestTypeEnum;
use src\Controllers\CategoryController;
use src\Controllers\ColorController;
use src\Controllers\SizeController;
use src\Controllers\ProductStockController;

switch (RequestTools::inputGet(ApiRouteEnum::API)) {
    case (ApiRouteEnum::PRODUCT):
        $controller = new ProductController();
        break;
    case (ApiRouteEnum::PRODUCT_STOCK):
        $controller = new ProductStockController();
        break;
    case (ApiRouteEnum::BRAND):
        $controller = new BrandController();
        break;
    case (ApiRouteEnum::CATEGORY):
        $controller = new CategoryController();
        break;
    case (ApiRouteEnum::COLOR):
        $controller = new ColorController();
        break;
    case (ApiRouteEnum::SIZE):
        $controller = new SizeController();
        break;
    default:
        Response::renderMethodNotAllowed();
}

if (isset($controller)) {
    switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
        case (RequestTypeEnum::POST):
            $controller->apiPost(RequestTools::inputPhpInput());
            unset($controller);
            break;
        case (RequestTypeEnum::PUT):
            $controller->apiPut(RequestTools::inputPhpInput());
            unset($controller);
            break;
        case (RequestTypeEnum::DELETE):
            $controller->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID));
            unset($controller);
            break;
        case (RequestTypeEnum::GET):
            $id = RequestTools::inputGet(FieldsEnum::ID);
            if ($id){
                $controller->apiGet((int)$id);
            } else {
                $controller->apiIndex();
            }
            unset($controller);
            break;
        default:
            Response::renderMethodNotAllowed();
    }
}