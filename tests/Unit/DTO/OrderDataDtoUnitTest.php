<?php

namespace tests\Unit\DTO;

use DateTime;
use PHPUnit\Framework\TestCase;
use src\DTO\OrderDataDTO;
use src\Enums\DocumentEnum;
use src\Enums\OrderEnum;
use src\Tools\DateTools;

class OrderDataDtoUnitTest extends TestCase
{
    public object $orderData;

    protected function setUp(): void
    {
        $this->orderData = new OrderDataDTO();
    }

    public function testDto()
    {
        $this->orderData->setId(951);
        $this->orderData->setCode('12584BXC');
        $this->orderData->setClientName('Fulaninho da Silva');
        $this->orderData->setClientDocumentType(DocumentEnum::CPF);
        $this->orderData->setClientDocument('985.785.258-88');
        $this->orderData->setClientMainPhone('(48)98475-5588');
        $this->orderData->setClientSecondPhone('(48)99655-4577');
        $this->orderData->setClientEmail('test@testmail.com');
        $this->orderData->setAddressStreet('Avenida Felipe Schmidt');
        $this->orderData->setAddressZipCode('887500-000');
        $this->orderData->setAddressNumber(2514);
        $this->orderData->setAddressComplement('Em frente a Tim');
        $this->orderData->setAddressDistrict('Centro');
        $this->orderData->setAddressCity('Braço do Norte');
        $this->orderData->setAddressState('SC');
        $this->orderData->setAddressReference(null);
        $this->orderData->setStatus(OrderEnum::STATUS_PAGO);
        $this->orderData->setCartId(852);
        $this->orderData->setTotalItensQuantity(2);
        $this->orderData->setGiftCardCode(null);
        $this->orderData->setGiftCardValue(null);
        $this->orderData->setShippingValue(14.50);
        $this->orderData->setTotalItensValue(111.09);
        $this->orderData->setExtraFareValue(2.50);
        $this->orderData->setTotalValue(128.09);
        $this->orderData->setShippingDeadline(5);
        $this->orderData->setCreatedAt(new DateTime('2022-10-01'));
        $this->orderData->setUpdatedAt(new DateTime('2022-11-25'));
        $this->assertEquals(951, $this->orderData->getId());
        $this->assertEquals('12584BXC', $this->orderData->getCode());
        $this->assertEquals('Fulaninho da Silva', $this->orderData->getClientName());
        $this->assertEquals(DocumentEnum::CPF, $this->orderData->getClientDocumentType());
        $this->assertEquals('985.785.258-88', $this->orderData->getClientDocument());
        $this->assertEquals('(48)98475-5588', $this->orderData->getClientMainPhone());
        $this->assertEquals('(48)99655-4577', $this->orderData->getClientSecondPhone());
        $this->assertEquals('test@testmail.com', $this->orderData->getClientEmail());
        $this->assertEquals('Avenida Felipe Schmidt', $this->orderData->getAddressStreet());
        $this->assertEquals('887500-000', $this->orderData->getAddressZipCode());
        $this->assertEquals(2514, $this->orderData->getAddressNumber());
        $this->assertEquals('Em frente a Tim', $this->orderData->getAddressComplement());
        $this->assertEquals('Centro', $this->orderData->getAddressDistrict());
        $this->assertEquals('Braço do Norte', $this->orderData->getAddressCity());
        $this->assertEquals('SC', $this->orderData->getAddressState());
        $this->assertEquals(null, $this->orderData->getAddressReference());
        $this->assertEquals(OrderEnum::STATUS_PAGO, $this->orderData->getStatus());
        $this->assertEquals(852, $this->orderData->getCartId());
        $this->assertEquals(2, $this->orderData->getTotalItensQuantity());
        $this->assertEquals(null, $this->orderData->getGiftCardCode());
        $this->assertEquals(null, $this->orderData->getGiftCardValue());
        $this->assertEquals(14.50, $this->orderData->getShippingValue());
        $this->assertEquals(111.09, $this->orderData->getTotalItensValue());
        $this->assertEquals(2.50, $this->orderData->getExtraFareValue());
        $this->assertEquals(128.09, $this->orderData->getTotalValue());
        $this->assertEquals(5, $this->orderData->getShippingDeadline());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($this->orderData->getCreatedAt()));
        $this->assertEquals('2022-11-25', DateTools::dateTimeToStringConverter($this->orderData->getUpdatedAt()));
    }
}