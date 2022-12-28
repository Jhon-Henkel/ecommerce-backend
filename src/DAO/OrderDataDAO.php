<?php

namespace src\DAO;

use src\DTO\OrderDataDTO;

class OrderDataDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        $column = 'order_data_code, order_data_client_name, order_data_client_document_type, ';
        $column .= 'order_data_client_document, order_data_client_main_phone, order_data_client_second_phone, ';
        $column .= 'order_data_client_email, order_data_address_street, order_data_address_zip_code, ';
        $column .= 'order_data_address_number, order_data_address_complement, order_data_address_district, ';
        $column .= 'order_data_address_city, order_data_address_state, order_data_address_reference, ';
        $column .= 'order_data_status, order_data_cart_id, order_data_itens_quantity, order_data_gift_card_code, ';
        $column .= 'order_data_gift_card_value, order_data_shipping_value, order_data_itens_value, ';
        $column .= 'order_data_extra_fare_value, order_data_total_value, order_data_shipping_deadline';
        return $column;
    }

    public function getParamsStringToInsert(): string
    {
        $params = ':code, :clientName, :clientDocumentType, :clientDocument, ';
        $params .= ':clientMainPhone, :clientSecondPhone, :clientEmail, :addressStreet, ';
        $params .= ':addressZipCode, :addressNumber, :addressComplement, :addressDistrict, ';
        $params .= ':addressCity, :addressState, :addressReference, :status, :cartId, ';
        $params .= ':totalItensQuantity, :giftCardCode, :giftCardValue, :shippingValue, ';
        $params .= ':itensValue, :extraFareValue, :totalValue, :shippingDeadline';
        return $params;
    }

    /**
     * @param OrderDataDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'code' => $item->getCode(),
            'clientName' => $item->getClientName(),
            'clientDocumentType' => $item->getClientDocumentType(),
            'clientDocument' => $item->getClientDocument(),
            'clientMainPhone' => $item->getClientMainPhone(),
            'clientSecondPhone' => $item->getClientSecondPhone(),
            'clientEmail' => $item->getClientEmail(),
            'addressStreet' => $item->getAddressStreet(),
            'addressZipCode' => $item->getAddressZipCode(),
            'addressNumber' => $item->getAddressNumber(),
            'addressComplement' => $item->getAddressComplement(),
            'addressDistrict' => $item->getAddressDistrict(),
            'addressCity' => $item->getAddressCity(),
            'addressState' => $item->getAddressState(),
            'addressReference' => $item->getAddressReference(),
            'status' => $item->getStatus(),
            'cartId' => $item->getCartId(),
            'totalItensQuantity' => $item->getTotalItensQuantity(),
            'giftCardCode' => $item->getGiftCardCode(),
            'giftCardValue' => $item->getGiftCardValue(),
            'shippingValue' => $item->getShippingValue(),
            'itensValue' => $item->getTotalItensValue(),
            'extraFareValue' => $item->getExtraFareValue(),
            'totalValue' => $item->getTotalValue(),
            'shippingDeadline' => $item->getShippingDeadline()
        );
    }

    public function getUpdateSting(): string
    {
        $updateString = 'order_data_code = :code, order_data_client_name = :clientName, ';
        $updateString .= 'order_data_client_document_type = :clientDocumentType, ';
        $updateString .= 'order_data_client_document = :clientDocument, ';
        $updateString .= 'order_data_client_main_phone = :clientMainPhone, ';
        $updateString .= 'order_data_client_second_phone = clientSecondPhone, ';
        $updateString .= 'order_data_client_email = :clientEmail, order_data_address_street = :addressStreet, ';
        $updateString .= 'order_data_address_zip_code = :addressZipCode, order_data_address_number = :addressNumber, ';
        $updateString .= 'order_data_address_complement = :addressComplement, ';
        $updateString .= 'order_data_address_district = :addressDistrict, ';
        $updateString .= 'order_data_address_city = :addressCity, order_data_address_state = :addressState, ';
        $updateString .= 'order_data_address_reference = :addressReference, order_data_status = :status, ';
        $updateString .= 'order_data_cart_id = :cartId, order_data_itens_quantity = :totalItensQuantity, ';
        $updateString .= 'order_data_gift_card_code = :giftCardCode, order_data_gift_card_value = :giftCardValue, ';
        $updateString .= 'order_data_shipping_value = :shippingValue, order_data_itens_value = :itensValue, ';
        $updateString .= 'order_data_extra_fare_value = :extraFareValue, order_data_total_value = :totalValue, ';
        $updateString .= 'order_data_shipping_deadline = :shippingDeadline';
        return $updateString;
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'order_data_id = :id';
    }

    /**
     * @param OrderDataDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}