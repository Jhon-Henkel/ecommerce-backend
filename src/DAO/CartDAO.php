<?php

namespace src\DAO;

use src\DTO\CartDTO;

class CartDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        return 'cart_client_id, cart_hash, cart_gift_card_id, cart_order_done';
    }

    public function getParamsStringToInsert(): string
    {
        return ':client, :hash, :giftCard, :orderDone';
    }

    /**
     * @param CartDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'client' => $item->getClientId(),
            'hash' => $item->getHash(),
            'giftCard' => $item->getGiftCardId(),
            'orderDone' => $item->getOrderDone()
        );
    }

    public function getUpdateSting(): string
    {
        // TODO: Implement getUpdateSting() method.
    }

    public function getWhereClausuleToUpdate(): string
    {
        // TODO: Implement getWhereClausuleToUpdate() method.
    }

    public function getParamsArrayToUpdate($item): array
    {
        // TODO: Implement getParamsArrayToUpdate() method.
    }
}