<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CartBO;
use src\BO\CartItemBO;
use src\DTO\CartDTO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\AttributesExceptions\RequiredAttributesMissingException;
use src\Exceptions\CartExceptions\CartAlreadyOrderedException;
use src\Exceptions\FieldsExceptions\InvalidUseForFieldException;
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
        try {
            $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
            $this->bo->validatePutParamsApi($this->fieldsToValidate, $object);
            $objectInDb = $this->bo->findById($object->id);
            $itemToUpdate = $this->factory->mergeObjectDbWitchObjectPut($objectInDb, $object);
            $this->bo->update($itemToUpdate);
            Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
        } catch (NotFoundException $exception) {
            Response::renderNotFound();
        } catch (RequiredAttributesMissingException $exception) {
            Response::renderRequiredAttributesMissing();
        } catch (AttributeNotFoundException $exception) {
            Response::renderAttributeNotFound($exception->getMessage());
        } catch (InvalidUseForFieldException $exception) {
            Response::renderInvalidUseForField($exception->getMessage());
        }
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