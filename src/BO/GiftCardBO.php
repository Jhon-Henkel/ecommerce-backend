<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\GiftCardDAO;
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
}