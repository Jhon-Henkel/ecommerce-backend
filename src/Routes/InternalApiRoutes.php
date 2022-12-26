<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ClientController;
use src\Api\Response;
use src\Controllers\AddressController;
use src\Controllers\GiftCardController;
use src\Controllers\CartController;
use src\Controllers\CartItemController;

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
        case (ApiRouteEnum::CART):
            $controller = new CartController();
            break;
        case (ApiRouteEnum::CART_ITEM):
            $controller = new CartItemController();
            break;
        default:
            Response::renderMethodNotAllowed();
    }
}