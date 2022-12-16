<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ProductController;
use src\Controllers\BrandController;
use src\Api\Response;
use src\Controllers\CategoryController;
use src\Controllers\ColorController;
use src\Controllers\SizeController;
use src\Controllers\ProductStockController;

if (RequestTools::inputGet(ApiRouteEnum::API)) {
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
}