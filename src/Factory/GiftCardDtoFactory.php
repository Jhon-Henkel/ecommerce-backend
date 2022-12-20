<?php

namespace src\Factory;

use src\DTO\GiftCardDTO;

class GiftCardDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): GiftCardDTO
    {
        $giftCard = new GiftCardDTO();
        $giftCard->setId($item->id ?? null);
        $giftCard->setCode($item->code);
        $giftCard->setStatus($item->status);
        $giftCard->setDiscount($item->discount);
        $giftCard->setDiscountType($item->discountType);
        $giftCard->setMaxUsages($item->maxUsages);
        $giftCard->setUsages($item->usages ?? 0);
        return $giftCard;
    }

    /**
     * @param GiftCardDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        $giftCard = new \stdClass();
        $giftCard->id = $item->getId();
        $giftCard->code = $item->getCode();
        $giftCard->status = $item->getStatus();
        $giftCard->discount = $item->getDiscount();
        $giftCard->discountType = $item->getDiscountType();
        $giftCard->maxUsages = $item->getMaxUsages();
        $giftCard->usages = $item->getUsages();
        return $giftCard;
    }

    public function populateDbToDto(array $item):GiftCardDTO
    {
        $giftCard = new GiftCardDTO();
        $giftCard->setId($item['gift_card_id']);
        $giftCard->setCode($item['gift_card_code']);
        $giftCard->setStatus($item['gift_card_status']);
        $giftCard->setDiscount($item['gift_card_discount']);
        $giftCard->setDiscountType($item['gift_card_discount_type']);
        $giftCard->setMaxUsages($item['gift_card_max_usages']);
        $giftCard->setUsages($item['gift_card_usages']);
        return $giftCard;
    }
}