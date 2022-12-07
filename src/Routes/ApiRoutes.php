<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ProductController;
use src\Controllers\BrandController;

switch (RequestTools::inputGet(ApiRouteEnum::API)) {
    case (ApiRouteEnum::PRODUCT):
        $productController = new ProductController();
        switch (RequestTools::inputGet(ApiRouteEnum::METHOD)) {
            case (ApiRouteEnum::POST):
                $productController->postApi(RequestTools::inputPhpInput());
                break;
        }
    case (ApiRouteEnum::BRAND):
        $brandController = new BrandController();
        switch (RequestTools::inputGet(ApiRouteEnum::METHOD)) {
            case (ApiRouteEnum::POST):
                $brandController->postApi(RequestTools::inputPhpInput());
        }
}
