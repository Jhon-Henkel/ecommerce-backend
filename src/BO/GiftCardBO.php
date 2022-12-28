<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\GiftCardDAO;
use src\DTO\GiftCardDTO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Factory\GiftCardDtoFactory;

class GiftCardBO extends BasicBO
{
    public GiftCardDAO $dao;
    public GiftCardDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new GiftCardDAO(TableEnum::GIFT_CARD);
        $this->factory = new GiftCardDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateItemValueMustNotExistsInDb(array(FieldsEnum::CODE), $item);
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            Response::renderNotFound();
        }
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateItemValueMustNotExistsInDbExceptId(array(FieldsEnum::CODE), $item, $item->id);
    }

    public function isValidGiftCardById(int $id): bool
    {
        /** @var GiftCardDTO $giftCard */
        $giftCard = $this->findById($id);
        if (!$giftCard) {
            return false;
        }
        if ($giftCard->getStatus() == 0) {
            return false;
        }
        if ($giftCard->getUsages() >= $giftCard->getMaxUsages()) {
            return false;
        }
        return true;
    }

    public function isValidDiscountOnCart(int $giftCardId, int $cartId): bool
    {
        /** @var GiftCardDTO $giftCard */
        $giftCard = $this->findById($giftCardId);
        $cartItemBO = new CartItemBO();
        $totalCartValue = $cartItemBO->getTotalItensAndValueOnCartId($cartId);
        if ($giftCard->getDiscount() > $totalCartValue['totalValue']) {
            return false;
        }
        return true;
    }

    public function updateGiftCardUsageById(int $id): void
    {
        /** @var GiftCardDTO $giftCard */
        $giftCard = $this->findById($id);
        $giftCard->setUsages(($giftCard->getUsages() + 1));
        $this->update($giftCard);
    }
}