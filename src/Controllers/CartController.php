<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CartBO;
use src\BO\CartItemBO;
use src\DTO\CartDTO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\CartExceptions\CartAlreadyOrderedException;
use src\Exceptions\GenericExceptions\NotFoundException;
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
        try {
            /** @var CartDTO $cart */
            $cart = $this->bo->findById($id);
            if (!$cart) {
                throw new NotFoundException();
            }
            $cartFactored = $this->bo->getCartWithStocksPublicByCart($cart);
            Response::render(HttpStatusCodeEnum::HTTP_OK, $cartFactored);
        } catch (NotFoundException $exception) {
            Response::renderNotFound();
        }
    }

    public function apiDelete(int $id)
    {
        try {
            if ($this->bo->validateOrderDoneByCartId($id)) {
                throw new CartAlreadyOrderedException();
            }
            $cartItemBO = new CartItemBO();
            $cartItemBO->deleteByCartId($id);
            $this->bo->deleteById($id);
            Response::render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
        } catch (CartAlreadyOrderedException $exception) {
            Response::renderCartHaveOrder();
        }
    }
}