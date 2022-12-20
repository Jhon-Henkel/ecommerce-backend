<?php

namespace src\Controllers;

use src\BO\GiftCardBO;
use src\Enums\FieldsEnum;
use src\Factory\GiftCardDtoFactory;

class GiftCardController extends BasicController
{
    public GiftCardBO $bo;
    public GiftCardDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new GiftCardBO();
        $this->factory = new GiftCardDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getGiftCardInsertRequiredFields();
    }
}