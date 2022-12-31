<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\ShippingBO;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\GenericExceptions\NotFoundException;

class ShippingController
{
    public ShippingBO $bo;

    public function __construct()
    {
        $this->bo = new ShippingBO();
    }

    public function calculateByCartId(int $id, string $destinationZipCode)
    {
        try {
            $calc = $this->bo->calculateShippingCartByCartId($id, $destinationZipCode);
            Response::render(HttpStatusCodeEnum::HTTP_OK, $calc);
        } catch (NotFoundException $exception) {
            Response::renderAttributeNotFound($exception->getMessage());
        }
    }

    public function calculateByStockId(int $id, string $destinationZipCode)
    {
        Response::render(HttpStatusCodeEnum::HTTP_OK, 'Em desenvolvimento!');
    }
}