<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ProductController;
use src\Controllers\BrandController;
use \src\Api\Response;

switch (RequestTools::inputGet(ApiRouteEnum::API)) {
    case (ApiRouteEnum::PRODUCT):
        $productController = new ProductController();
        break;
    case (ApiRouteEnum::BRAND):
        $brandController = new BrandController();
        switch (RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD)) {
            case (ApiRouteEnum::POST):
                $brandController->postApi(RequestTools::inputPhpInput());
                break;
            case (ApiRouteEnum::PUT):
                $brandController->putApi(RequestTools::inputPhpInput());
                break;
            default:
                Response::RenderMethodNotAllowed();
        }
}
