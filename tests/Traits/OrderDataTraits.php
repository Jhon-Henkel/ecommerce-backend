<?php

namespace tests\Traits;

use src\DTO\OrderDataDTO;
use src\Enums\DocumentEnum;
use src\Enums\OrderEnum;
use stdClass;

trait OrderDataTraits
{
    public function makeStdOrderData951(): stdClass
    {
        $order = new stdClass();
        $order->id = 951;
        $order->code = '12584BXC';
        $order->clientName = 'Fulaninho da Silva';
        $order->clientDocumentType = DocumentEnum::CPF;
        $order->clientDocument = '985.785.258-88';
        $order->clientMainPhone = '(48)98475-5588';
        $order->clientSecondPhone = '(48)99655-4577';
        $order->clientEmail = 'test@testmail.com';
        $order->addressStreet = 'Avenida Felipe Schimidt';
        $order->addressZipCode = '887500-000';
        $order->addressNumber = 2514;
        $order->addressComplement = 'Em frente a Tim';
        $order->addressDistrict = 'Centro';
        $order->addressCity = 'Braço do Norte';
        $order->addressState = 'SC';
        $order->addressReference = null;
        $order->status = OrderEnum::STATUS_PAGO;
        $order->cartId = 852;
        $order->totalItensQuantity = 2;
        $order->giftCardCode = null;
        $order->giftCardValue = null;
        $order->shippingValue = 14.50;
        $order->totalItensValue = 111.09;
        $order->extraFareValue = 2.50;
        $order->totalValue = 128.09;
        $order->shippingDeadline = 5;
        return $order;
    }

    public function makeDtoOrderData951(): OrderDataDTO
    {
        $order = new OrderDataDTO();
        $order->setId(951);
        $order->setCode('12584BXC');
        $order->setClientName('Fulaninho da Silva');
        $order->setClientDocumentType(DocumentEnum::CPF);
        $order->setClientDocument('985.785.258-88');
        $order->setClientMainPhone('(48)98475-5588');
        $order->setClientSecondPhone('(48)99655-4577');
        $order->setClientEmail('test@testmail.com');
        $order->setAddressStreet('Avenida Felipe Schimidt');
        $order->setAddressZipCode('887500-000');
        $order->setAddressNumber(2514);
        $order->setAddressComplement('Em frente a Tim');
        $order->setAddressDistrict('Centro');
        $order->setAddressCity('Braço do Norte');
        $order->setAddressState('SC');
        $order->setAddressReference(null);
        $order->setStatus(OrderEnum::STATUS_PAGO);
        $order->setCartId(852);
        $order->setTotalItensQuantity(2);
        $order->setGiftCardCode(null);
        $order->setGiftCardValue(null);
        $order->setShippingValue(14.50);
        $order->setTotalItensValue(111.09);
        $order->setExtraFareValue(2.50);
        $order->setTotalValue(128.09);
        $order->setShippingDeadline(5);
        return $order;
    }
}