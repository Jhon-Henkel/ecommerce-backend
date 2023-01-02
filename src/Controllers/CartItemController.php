<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\CartItemBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyExistsException;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\AttributesExceptions\RequiredAttributesMissingException;
use src\Exceptions\CartExceptions\CartDontAllowInsertItensException;
use src\Exceptions\FieldsExceptions\InvalidFieldValueException;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Exceptions\ProductExceptions\InsufficientStockBalanceForItemException;
use src\Exceptions\ProductExceptions\OutOfStockItemException;
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
        try {
            $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
            $itemToInsert = $this->factory->factory($object);
            $this->bo->insert($itemToInsert);
            $inserted = $this->bo->findLastInserted();
            Response::render(HttpStatusCodeEnum::HTTP_CREATED, $this->factory->makePublic($inserted));
        } catch (AttributeNotFoundException $exception) {
            Response::renderAttributeNotFound($exception->getMessage());
        } catch (CartDontAllowInsertItensException $exception) {
            Response::renderCartDontAllowInsertItens();
        } catch (AttributeAlreadyExistsException $exception) {
            Response::renderAttributeAlreadyExistsInThisCart($exception->getMessage());
        } catch (InsufficientStockBalanceForItemException $exception) {
            Response::renderInsufficientStockBalanceItem();
        } catch (OutOfStockItemException $exception) {
            Response::renderOutOfStockItem();
        } catch (InvalidFieldValueException $exception) {
            Response::renderInvalidFieldValue($exception->getMessage());
        } catch (RequiredAttributesMissingException $exception) {
            Response::renderRequiredAttributesMissing();
        }
    }

    public function apiPut(\stdClass $object)
    {
        try {
            $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
            $this->bo->validatePutParamsApi(array(FieldsEnum::QUANTITY), $object);
            $item = $this->bo->findById($object->id);
            $this->bo->validateStockHaveBalanceByStockId($item->getStockId(), $object->quantity);
            $itemToUpdate = $this->factory->factoryItemPut($object, $item);
            $this->bo->update($itemToUpdate);
            Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
        } catch (InsufficientStockBalanceForItemException $exception) {
            Response::renderInsufficientStockBalanceItem();
        } catch (OutOfStockItemException $exception) {
            Response::renderOutOfStockItem();
        } catch (NotFoundException) {
            Response::renderNotFound();
        } catch (InvalidFieldValueException $exception) {
            Response::renderInvalidFieldValue($exception->getMessage());
        } catch (RequiredAttributesMissingException $exception) {
            Response::renderRequiredAttributesMissing();
        }
    }

    public function apiDelete(int $id)
    {
        if ($this->bo->validateOrderDoneByCartItemId($id)) {
            Response::renderItemHaveOrder();
        }
        parent::apiDelete($id);
    }
}