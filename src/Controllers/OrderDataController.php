<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\OrderDataBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\OrderDataDtoFactory;

class OrderDataController extends BasicController
{
    public OrderDataBO $bo;
    public OrderDataDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new OrderDataBO();
        $this->factory = new OrderDataDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getOrderDataInsertRequiredFields();
    }

    public function apiPost(\stdClass $object)
    {
        $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
        $itemToInsert = $this->factory->factoryToInsert($object);
        $this->bo->insert($itemToInsert);
        $this->bo->afterInsert($itemToInsert->getCartId());
        $inserted = $this->bo->findLastInserted();
        Response::render(HttpStatusCodeEnum::HTTP_CREATED, $this->factory->makePublic($inserted));
    }
}