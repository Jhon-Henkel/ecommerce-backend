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

switch (RequestTools::inputGet(ApiRouteEnum::API)) {
    case (ApiRouteEnum::PRODUCT):
        $productController = new ProductController();
        break;
    case (ApiRouteEnum::BRAND):
        $brandController = new BrandController();
        switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
            case (RequestTypeEnum::POST):
                $brandController->apiPost(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::PUT):
                $brandController->apiPut(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::DELETE):
                $brandController->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID));
                break;
            case (RequestTypeEnum::GET):
                if (RequestTools::inputGet(FieldsEnum::ID)){
                    $brandController->apiGet((int)RequestTools::inputGet(FieldsEnum::ID));
                } else {
                    $brandController->apiIndex();
                }
                break;
            default:
                Response::RenderMethodNotAllowed();
        }
    case (ApiRouteEnum::CATEGORY):
        $categoryController = new CategoryController();
        switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
            case(RequestTypeEnum::POST):
                $categoryController->apiPost(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::PUT):
                $categoryController->apiPut(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::DELETE):
                $categoryController->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID));
                break;
            case (RequestTypeEnum::GET):
                if (RequestTools::inputGet(FieldsEnum::ID)){
                    $categoryController->apiGet((int)RequestTools::inputGet(FieldsEnum::ID));
                } else {
                    $categoryController->apiIndex();
                }
                break;
            default:
                Response::RenderMethodNotAllowed();
        }
    case (ApiRouteEnum::COLOR):
        $colorController = new ColorController();
        switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
            case (RequestTypeEnum::POST):
                $colorController->apiPost(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::PUT):
                $colorController->apiPut(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::DELETE):
                $colorController->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID));
                break;
            case (RequestTypeEnum::GET):
                if (RequestTools::inputGet(FieldsEnum::ID)){
                    $colorController->apiGet((int)RequestTools::inputGet(FieldsEnum::ID));
                } else {
                    $colorController->apiIndex();
                }
                break;
            default:
                Response::RenderMethodNotAllowed();
        }
    case (ApiRouteEnum::SIZE):
        $sizeController = new SizeController();
        switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
            case (RequestTypeEnum::POST):
                $sizeController->apiPost(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::PUT):
                $sizeController->apiPut(RequestTools::inputPhpInput());
                break;
            case (RequestTypeEnum::DELETE):
                $sizeController->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID));
                break;
            case (RequestTypeEnum::GET):
                if (RequestTools::inputGet(FieldsEnum::ID)){
                    $sizeController->apiGet((int)RequestTools::inputGet(FieldsEnum::ID));
                } else {
                    $sizeController->apiIndex();
                }
                break;
            default:
                Response::RenderMethodNotAllowed();
        }
    default:
        Response::RenderMethodNotAllowed();
}
