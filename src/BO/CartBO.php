<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CartDAO;
use src\Enums\CartEnum;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Factory\CartDtoFactory;

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
            if (!$this->validateGiftCard((int)$item->giftCardId)) {
                Response::renderAttributeNotFound(FieldsEnum::GIFT_CART_ID_JSON);
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

    public function validateGiftCard(int $giftCardId): bool
    {
        $giftCardBO = new GiftCardBO();
        return (bool)$giftCardBO->countById($giftCardId);
    }
}