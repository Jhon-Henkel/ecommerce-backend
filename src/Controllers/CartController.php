<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CartBO;
use src\BO\CartItemBO;
use src\DTO\CartDTO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\CartDtoFactory;
use src\Tools\RequestTools;

class CartController extends BasicController
{
    public CartBO $bo;
    public CartDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new CartBO();
        $this->factory = new CartDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getCartInsertRequiredFields();
    }

    public function apiPut(\stdClass $object)
    {
        $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $this->bo->validatePutParamsApi($this->fieldsToValidate, $object);
        $objectInDb = $this->bo->findById($object->id);
        $itemToUpdate = $this->factory->mergeObjectDbWitchObjectPut($objectInDb, $object);
        $this->bo->update($itemToUpdate);
        Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
    }

    public function apiGet(int $id)
    {
        /** @var CartDTO $cart */
        $cart = $this->bo->findById($id);
        if ($cart){
            $itemBO = new CartItemBO();
            $cartFactored = $this->factory->makePublic($cart);
            $cartFactored->cartItens = $itemBO->findAllByCartId($cart->getId());
            Response::render(HttpStatusCodeEnum::HTTP_OK, $cartFactored);
        }
        Response::renderNotFound();
    }

    public function apiDelete(int $id)
    {
        $cartItemBO = new CartItemBO();
        $cartItemBO->deleteByCartId($id);
        $this->bo->deleteById($id);
        Response::render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
    }
}