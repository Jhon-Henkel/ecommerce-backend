<?php

require_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/src/Routes/PublicApiRoutes.php';
include_once __DIR__ . '/src/Routes/InternalApiRoutes.php';

use src\Enums\FieldsEnum;
use src\Enums\RequestTypeEnum;
use src\Api\Response;
use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;

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
            $controller->apiDelete((int)RequestTools::inputGet(FieldsEnum::ID_JSON));
            unset($controller);
            break;
        case (RequestTypeEnum::GET):
            $id = RequestTools::inputGet(FieldsEnum::ID_JSON);
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