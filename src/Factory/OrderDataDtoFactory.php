<?php

namespace src\Factory;

use Exception;
use src\BO\AddressBO;
use src\BO\CartBO;
use src\BO\CartItemBO;
use src\BO\ClientBO;
use src\BO\GiftCardBO;
use src\BO\OrderDataBO;
use src\DTO\AddressDTO;
use src\DTO\GiftCardDTO;
use src\DTO\OrderDataDTO;
use src\Tools\DateTools;
use stdClass;

class OrderDataDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): OrderDataDTO
    {
        // TODO: Implement factory() method.
    }

    /**
     * @param OrderDataDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $order = new stdClass();
        $order->id = $item->getId();
        $order->code = $item->getCode();
        $order->clientName = $item->getClientName();
        $order->clientDocumentType = $item->getClientDocumentType();
        $order->clientDocument = $item->getClientDocument();
        $order->clientMainPhone = $item->getClientMainPhone();
        $order->clientSecondPhone = $item->getClientSecondPhone();
        $order->clientEmail = $item->getClientEmail();
        $order->addressStreet = $item->getAddressStreet();
        $order->addressZipCode = $item->getAddressZipCode();
        $order->addressNumber = $item->getAddressNumber();
        $order->addressComplement = $item->getAddressComplement();
        $order->addressDistrict = $item->getAddressDistrict();
        $order->addressCity = $item->getAddressCity();
        $order->addressState = $item->getAddressState();
        $order->addressReference = $item->getAddressReference();
        $order->status = $item->getStatus();
        $order->cartId = $item->getCartId();
        $order->totalItensQuantity = $item->getTotalItensQuantity();
        $order->giftCardCode = $item->getGiftCardCode();
        $order->giftCardValue = $item->getGiftCardValue();
        $order->shippingValue = $item->getShippingValue();
        $order->totalItensValue = $item->getTotalItensValue();
        $order->extraFareValue = $item->getExtraFareValue();
        $order->totalValue = $item->getTotalValue();
        $order->shippingDeadline = $item->getShippingDeadline();
        $order->createdAt = DateTools::dateTimeToStringConverter($item->getCreatedAt());
        $order->updatedAt = DateTools::dateTimeToStringConverter($item->getUpdatedAt());
        return $order;
    }

    /**
     * @throws Exception
     */
    public function populateDbToDto(array $item): OrderDataDTO
    {
        $order = new OrderDataDTO();
        $order->setId($item['order_data_id']);
        $order->setCode($item['order_data_code']);
        $order->setClientName($item['order_data_client_name']);
        $order->setClientDocumentType($item['order_data_client_document_type']);
        $order->setClientDocument($item['order_data_client_document']);
        $order->setClientMainPhone($item['order_data_client_main_phone']);
        $order->setClientSecondPhone($item['order_data_client_second_phone']);
        $order->setClientEmail($item['order_data_client_email']);
        $order->setAddressStreet($item['order_data_address_street']);
        $order->setAddressZipCode($item['order_data_address_zip_code']);
        $order->setAddressNumber($item['order_data_address_number']);
        $order->setAddressComplement($item['order_data_address_complement']);
        $order->setAddressDistrict($item['order_data_address_district']);
        $order->setAddressCity($item['order_data_address_city']);
        $order->setAddressState($item['order_data_address_state']);
        $order->setAddressReference($item['order_data_address_reference']);
        $order->setStatus($item['order_data_status']);
        $order->setCartId($item['order_data_cart_id']);
        $order->setTotalItensQuantity($item['order_data_itens_quantity']);
        $order->setGiftCardCode($item['order_data_gift_card_code']);
        $order->setGiftCardValue($item['order_data_gift_card_value']);
        $order->setShippingValue($item['order_data_shipping_value']);
        $order->setTotalItensValue($item['order_data_itens_value']);
        $order->setExtraFareValue($item['order_data_extra_fare_value']);
        $order->setTotalValue($item['order_data_total_value']);
        $order->setShippingDeadline($item['order_data_shipping_deadline']);
        $order->setCreatedAt(DateTools::stringToDateTimeConverter($item['order_data_created_at']));
        $order->setUpdatedAt(DateTools::stringToDateTimeConverter($item['order_data_updated_at']));
        return $order;
    }

    public function factoryToInsert(stdClass $item): OrderDataDTO
    {
        $cartBO = new CartBO();
        $orderBO = new OrderDataBO();
        $clientBO = new ClientBO();
        $addressBO = new AddressBO();
        $cartItemBO = new CartItemBO();
        $cart = $cartBO->findById((int)$item->cartId);
        $client = $clientBO->findById((int)$item->clientId);
        /** @var AddressDTO $address */
        $address = $addressBO->findById((int)$item->addressId);
        $giftCardValue = 0;
        $shippingValue = $item->shippingValue ?? 0;
        $extraFare = $item->extraFareValue ?? 0;
        $shippingDeadline = $item->shippingDeadline ?? null;
        $itensInfo = $cartItemBO->getTotalItensAndValueOnCartId((int)$item->cartId);
        $order = new OrderDataDTO();
        $order->setCode(uniqid());
        $order->setClientName($client->name);
        $order->setClientDocumentType($client->documentType);
        $order->setClientDocument($client->document);
        $order->setClientEmail($client->email);
        $order->setClientMainPhone($client->mainPhone);
        $order->setClientSecondPhone($client->secondPhone);
        $order->setAddressCity($address->getCity());
        $order->setAddressComplement($address->getComplement());
        $order->setAddressDistrict($address->getDistrict());
        $order->setAddressNumber($address->getNumber());
        $order->setAddressReference($address->getReference());
        $order->setAddressState($address->getState());
        $order->setAddressStreet($address->getStreet());
        $order->setAddressZipCode($address->getZipCode());
        $order->setStatus((int)$item->status);
        $order->setCartId((int)$item->cartId);
        if ($cart->getGiftCardId()) {
            $giftCardBO = new GiftCardBO();
            /** @var GiftCardDTO $giftCard */
            $giftCard = $giftCardBO->findById($cart->getGiftCardId());
            $giftCardValue = $giftCard->getDiscount();
            $order->setGiftCardCode($giftCard->getCode());
            $order->setGiftCardValue($giftCardValue);
        } else {
            $order->setGiftCardCode(null);
            $order->setGiftCardValue(null);
        }
        $order->setShippingValue($shippingValue);
        $order->setTotalItensQuantity($itensInfo['totalItens']);
        $order->setTotalItensValue($itensInfo['totalValue']);
        $order->setExtraFareValue($extraFare);
        $order->setShippingDeadline($shippingDeadline);
        $order->setTotalValue(
            $orderBO->calculateTotalOrderValue(
                $itensInfo['totalValue'],
                $extraFare,
                $giftCardValue,
                $shippingValue
            )
        );
        return $order;
    }

    public function makeCompletePublicOrder(OrderDataDTO $order): stdClass
    {
        $cartBO = new CartBO();
        $cart = $cartBO->getCartWithStocksPublicByCart($cartBO->findById($order->getCartId()));
        $completeOrder = new stdClass();
        $completeOrder->id = $order->getId();
        $completeOrder->code = $order->getCode();
        $completeOrder->client = new stdClass();
        $completeOrder->client->name = $order->getClientName();
        $completeOrder->client->documentType = $order->getClientDocumentType();
        $completeOrder->client->document = $order->getClientDocument();
        $completeOrder->client->minPhone = $order->getClientMainPhone();
        $completeOrder->client->secondPhone = $order->getClientSecondPhone();
        $completeOrder->client->email = $order->getClientEmail();
        $completeOrder->address = new stdClass();
        $completeOrder->address->street = $order->getAddressStreet();
        $completeOrder->address->zipCode = $order->getAddressZipCode();
        $completeOrder->address->number = $order->getAddressNumber();
        $completeOrder->address->complement = $order->getAddressComplement();
        $completeOrder->address->district = $order->getAddressDistrict();
        $completeOrder->address->city = $order->getAddressCity();
        $completeOrder->address->state = $order->getAddressState();
        $completeOrder->address->reference = $order->getAddressReference();
        $completeOrder->cart = $cart;
        $completeOrder->tatalItensQuantity = $order->getTotalItensQuantity();
        $completeOrder->giftCardValue = $order->getGiftCardValue();
        $completeOrder->giftCardCode = $order->getGiftCardCode();
        $completeOrder->shippingValue = $order->getShippingValue();
        $completeOrder->totalItensValue = $order->getTotalItensValue();
        $completeOrder->extraFareValue = $order->getExtraFareValue();
        $completeOrder->totalValue = $order->getTotalValue();
        $completeOrder->shippingDeadline = $order->getShippingDeadline();
        $completeOrder->createdAt = DateTools::dateTimeToStringConverter($order->getCreatedAt());
        $completeOrder->updatedAt = DateTools::dateTimeToStringConverter($order->getUpdatedAt());
        return $completeOrder;
    }

    public function mergeObjectDbWitchObjectPut(OrderDataDTO $objectDb, stdClass $objectPut): OrderDataDTO
    {
        if (isset($objectPut->status)) {
            $objectDb->setStatus((int)$objectPut->status);
        }
        return $objectDb;
    }
}