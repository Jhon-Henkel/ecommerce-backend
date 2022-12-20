<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ClientController;
use src\Api\Response;
use src\Controllers\AddressController;
use src\Controllers\GiftCardController;

if (RequestTools::inputGet(ApiRouteEnum::APP)) {
    switch (RequestTools::inputGet(ApiRouteEnum::APP)) {
        case (ApiRouteEnum::CLIENT):
            $controller = new ClientController();
            break;
        case (ApiRouteEnum::ADDRESS):
            $controller = new AddressController();
            break;
        case (ApiRouteEnum::GIFT_CARD):
            $controller = new GiftCardController();
            break;
        default:
            Response::renderMethodNotAllowed();
    }
}