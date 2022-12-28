<?php

namespace src\DAO;

use src\DTO\GiftCardDTO;

class GiftCardDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        $columns = 'gift_card_code, gift_card_discount_type, gift_card_discount,';
        $columns .= ' gift_card_max_usages, gift_card_status';
        return $columns;
    }

    public function getParamsStringToInsert(): string
    {
        return ':code, :type, :discount, :maxUsages, :status';
    }

    /**
     * @param GiftCardDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'code' => $item->getCode(),
            'type' => $item->getDiscountType(),
            'discount'=> $item->getDiscount(),
            'maxUsages' => $item->getMaxUsages(),
            'status' => $item->getStatus()
        );
    }

    public function getUpdateSting(): string
    {
        $update = 'gift_card_code = :code, gift_card_discount_type = :type, gift_card_discount = :discount,';
        $update .= ' gift_card_max_usages = :maxUsages, gift_card_status = :status, gift_card_usages = :usages';
        return $update;
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'gift_card_id = :id';
    }

    /**
     * @param GiftCardDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        return array_merge(
            $this->getParamsArrayToInsert($item),
            array(
                'id' => $item->getId(),
                'usages' => $item->getUsages()
            )
        );
    }
}