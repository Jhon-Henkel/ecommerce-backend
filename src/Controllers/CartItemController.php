<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CartItemBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\CartItemDtoFactory;
use src\Tools\RequestTools;

class CartItemController extends BasicController
{
    public CartItemBO $bo;
    public CartItemDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new CartItemBO();
        $this->factory = new CartItemDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getCartItemInsertRequiredFields();
    }

    public function apiPost(\stdClass $object): void
    {
        $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
        $itemToInsert = $this->factory->factory($object);
        $this->bo->insert($itemToInsert);
        $inserted = $this->bo->findLastInserted();
        Response::render(HttpStatusCodeEnum::HTTP_CREATED, $this->factory->makePublic($inserted));
    }

    public function apiPut(\stdClass $object)
    {
        $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $this->bo->validatePutParamsApi(array(FieldsEnum::QUANTITY), $object);
        $item = $this->bo->findById($object->id);
        $this->bo->validateStockHaveBalanceByStockId($item->getStockId(), $object->quantity);
        $itemToUpdate = $this->factory->factoryItemPut($object, $item);
        $this->bo->update($itemToUpdate);
        Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
    }

    public function apiDelete(int $id)
    {
        if ($this->bo->validateOrderDoneByCartItemId($id)) {
            Response::renderItemHaveOrder();
        }
        parent::apiDelete($id);
    }
}