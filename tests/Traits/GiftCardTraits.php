<?php

namespace tests\Traits;

use src\Database;
use src\DTO\GiftCardDTO;
use stdClass;

trait GiftCardTraits
{
    public function makeDtoGiftCardTest1445(): GiftCardDTO
    {
        $item = new GiftCardDTO();
        $item->setId(1234);
        $item->setCode("CUPOM100");
        $item->setDiscountType(1);
        $item->setStatus(1);
        $item->setDiscount(10.45);
        $item->setMaxUsages(99);
        return $item;
    }

    public function makeStdGiftCardTest1445(): stdClass
    {
        $item = new stdClass();
        $item->id = 1234;
        $item->code = "CUPOM100";
        $item->discountType = 1;
        $item->status = 1;
        $item->discount = 10.45;
        $item->maxUsages = 99;
        return $item;
    }

    public function makeDbGiftCardTest1445(): array
    {
        $item = array();
        $item['gift_card_id'] = 1234;
        $item['gift_card_code'] = "CUPOM100";
        $item['gift_card_discount_type'] = 1;
        $item['gift_card_status'] = 1;
        $item['gift_card_discount'] = 10.45;
        $item['gift_card_max_usages'] = 99;
        $item['gift_card_usages'] = 1;
        return $item;
    }

    public function insertOnDbGiftCard987()
    {
        $columns = 'gift_card_id, gift_card_code, gift_card_discount_type, ';
        $columns .= 'gift_card_discount, gift_card_max_usages, gift_card_status';
        $query = "INSERT INTO gift_card ($columns) VALUES (987, 'COUPOM10', 1, 10.00, 99, 1)";
        $db = new Database();
        $db->insert($query);
    }

    public function deleteOnDbGiftCard987()
    {
        $db = new Database();
        $db->delete("DELETE FROM gift_card WHERE gift_card_id = 987");
    }
}