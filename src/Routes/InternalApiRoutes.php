<?php

use src\Tools\RequestTools;
use src\Enums\ApiRouteEnum;
use src\Controllers\ClientController;
use src\Api\Response;
use src\Controllers\AddressController;
use src\Controllers\GiftCardController;
use src\Controllers\CartController;
use src\Controllers\CartItemController;
use src\Controllers\OrderDataController;
use src\Enums\ShippingEnum;
use src\Controllers\ShippingController;
use src\Enums\FieldsEnum;
use src\Enums\RequestTypeEnum;

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
        case (ApiRouteEnum::ORDER):
            $controller = new OrderDataController();
            break;
        case (ApiRouteEnum::CALCULATE_SHIPPING):
            if (
                RequestTools::inputServer(ApiRouteEnum::REQUEST_METHOD) != RequestTypeEnum::GET
                || !RequestTools::inputGet(ApiRouteEnum::TYPE)
                || !RequestTools::inputGet(FieldsEnum::ID)
                || !RequestTools::inputGet(FieldsEnum::ZIP_CODE_URL)
            ) {
                Response::renderMethodNotAllowed();
            }
            $shippingController = new ShippingController();
            $id = RequestTools::inputGet(FieldsEnum::ID);
            $destinationZipCode = RequestTools::inputGet(FieldsEnum::ZIP_CODE_URL);
            switch (RequestTools::inputGet(ApiRouteEnum::TYPE)) {
                case (ShippingEnum::CALCULATE_TYPE_CART):
                    $shippingController->calculateByCartId((int)$id, $destinationZipCode);
                    break;
                case (ShippingEnum::CALCULATE_TYPE_SINGLE_ITEM):
                    $shippingController->calculateByStockId((int)$id, $destinationZipCode);
                    break;
                default:
                    Response::renderMethodNotAllowed();
            }
            break;
        default:
            Response::renderMethodNotAllowed();
    }
}