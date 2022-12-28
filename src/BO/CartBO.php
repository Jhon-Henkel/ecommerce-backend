<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CartDAO;
use src\DTO\CartDTO;
use src\DTO\GiftCardDTO;
use src\Enums\ApiResponseMessageEnum;
use src\Enums\CartEnum;
use src\Enums\FieldsEnum;
use src\Enums\OrderEnum;
use src\Enums\StatusEnum;
use src\Enums\TableEnum;
use src\Factory\CartDtoFactory;
use src\Tools\ValidateTools;

class CartBO extends BasicBO
{
    public CartDAO $dao;
    public CartDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new CartDAO(TableEnum::CART);
        $this->factory = new CartDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        if (!$this->validateClient((int)$item->clientId)) {
            Response::renderAttributeNotFound(FieldsEnum::CLIENT_ID_JSON);
        }
        if (!$this->validateCartClient((int)$item->clientId)) {
            Response::renderCartOpenForThisClient();
        }
        if (isset($item->giftCardId)) {
            if (!$this->validateGiftCardExistsById((int)$item->giftCardId)) {
                Response::renderAttributeNotFound(FieldsEnum::GIFT_CART_ID_JSON);
            }
            if (!$this->isValidGiftCardById((int)$item->giftCardId)) {
                Response::renderInvalidUseForField(FieldsEnum::GIFT_CART_ID_JSON);
            }
        }
    }

    public function validateClient(int $clientId): bool
    {
        $clientBO = new ClientBO();
        return (bool)$clientBO->countById($clientId);
    }

    public function validateCartClient(int $clientId): bool
    {
        if (
            $this->dao->countByColumnValue(FieldsEnum::CLIENT_ID_DB, $clientId)
            && $this->dao->countByColumnValue(FieldsEnum::ORDER_DONE_DB, CartEnum::ORDER_DONT_DONE)
        ) {
            return false;
        }
        return true;
    }

    public function validateGiftCardExistsById(int $giftCardId): bool
    {
        $giftCardBO = new GiftCardBO();
        return (bool)$giftCardBO->countById($giftCardId);
    }

    public function isValidGiftCardById(int $giftCardId): bool
    {
        $giftCardBO = new GiftCardBO();
        /**@var GiftCardDTO $giftCard */
        $giftCard = $giftCardBO->findById($giftCardId);
        if ($giftCard->getUsages() >= $giftCard->getMaxUsages()) {
            return false;
        }
        if ($giftCard->getStatus() == StatusEnum::INATIVE) {
            return false;
        }
        return true;
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            Response::renderNotFound();
        }
        if (!ValidateTools::validateParamsFieldsInArray(array(FieldsEnum::ORDER_DONE_JSON), (array)$item)) {
            Response::renderRequiredAttributesMissing();
        }
        if (isset($item->giftCardId)) {
            if (!$this->validateGiftCardExistsById((int)$item->giftCardId)) {
                Response::renderAttributeNotFound(FieldsEnum::GIFT_CART_ID_JSON);
            }
            if (!$this->isValidGiftCardById((int)$item->giftCardId)) {
                Response::renderInvalidUseForField(FieldsEnum::GIFT_CART_ID_JSON);
            }
        }
    }

    public function validateOrderDoneByCartId(int $cartId): bool
    {
        $cart = $this->findById($cartId);
        if ($cart->getOrderDone() == OrderEnum::ORDER_DONE) {
            return true;
        }
        return false;
    }

    public function updateCartOrderDone(CartDTO $cart): void
    {
        $cart->setOrderDone(OrderEnum::ORDER_DONE);
        $this->update($cart);
    }

    public function validateCartToOrderById(int $cartId): void
    {
        $cart = $this->findById($cartId);
        if (!$cart) {
            Response::renderAttributeNotFound(FieldsEnum::CART_ID_JSON);
        }
        if ($cart->getGiftCardId()) {
            $giftCardBO = new GiftCardBO();
            if (!$giftCardBO->isValidGiftCardById($cart->getGiftCardId())) {
                Response::renderInvalidUseForField(ApiResponseMessageEnum::INVALID_GIFT_CARD_IN_THIS_CART);
            }
            if (!$giftCardBO->isValidDiscountOnCart($cart->getGiftCardId(), $cartId)) {
                Response::renderInvalidFieldValue(ApiResponseMessageEnum::INVALID_VALUE_GIFT_CARD_FOR_THIS_CART);
            }
        }
        $cartItemBO = new CartItemBO();
        $itens = $cartItemBO->findAllByCartId($cartId);
        if (!$itens) {
            Response::renderCartDontHaveItens();
        }
        $cartItemBO->validateItensStockBalance($itens);
    }

    public function getCartWithStocksPublicByCart(CartDTO $cart): \stdClass
    {
        $itemBO = new CartItemBO();
        $cartFactored = $this->factory->makePublic($cart);
        $cartFactored->cartItens = $itemBO->findAllByCartId($cart->getId());
        return $cartFactored;
    }
}