<?php

namespace src\Factory;

use src\DTO\CartDTO;
use src\Enums\CartEnum;
use src\Tools\DateTools;
use src\Tools\SecurityTools;
use stdClass;

class CartDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): CartDTO
    {
        $cart = new CartDTO();
        $cart->setId($item->id ?? null);
        $cart->setClientId($item->clientId);
        $cart->setHash($item->hash ?? SecurityTools::generateMd5UniqId());
        $cart->setGiftCardId($item->giftCardId ?? null);
        $cart->setOrderDone($item->orderDone ?? CartEnum::ORDER_DONT_DONE);
        $cart->setCreatedAt($item->createdAt ?? null);
        $cart->setUpdatedAt($item->updatedAt ?? null);
        return $cart;
    }

    /**
     * @param CartDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $cart = new stdClass();
        $cart->id = $item->getId();
        $cart->clientId = $item->getClientId();
        $cart->hash = $item->getHash();
        $cart->giftCardId = $item->getGiftCardId();
        $cart->orderDone = $item->getOrderDone();
        $cart->createdAt = $item->getCreatedAt() ? DateTools::dateTimeToStringConverter($item->getCreatedAt()) : null;
        $cart->updatedAt = $item->getUpdatedAt() ? DateTools::dateTimeToStringConverter($item->getUpdatedAt()) : null;
        return $cart;
    }

    public function populateDbToDto(array $item): CartDTO
    {
        $cart = new CartDTO();
        $cart->setId($item['cart_id']);
        $cart->setClientId($item['cart_client_id']);
        $cart->setHash($item['cart_hash']);
        $cart->setGiftCardId($item['cart_gift_card_id']);
        $cart->setOrderDone($item['cart_order_done']);
        $cart->setCreatedAt(DateTools::stringToDateTimeConverter($item['cart_created_at']));
        $cart->setUpdatedAt(
            $item['cart_updated_at']
                ? DateTools::stringToDateTimeConverter($item['cart_updated_at'])
                : null
        );
        return $cart;
    }
}