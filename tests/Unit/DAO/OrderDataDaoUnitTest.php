<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\OrderDataDAO;

class OrderDataDaoUnitTest extends TestCase
{
    public OrderDataDAO $dao;

    protected function setUp(): void
    {
        $this->dao = new OrderDataDAO('test_table');
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expect = 'order_data_code, order_data_client_name, order_data_client_document_type, ';
        $expect .= 'order_data_client_document, order_data_client_main_phone, order_data_client_second_phone, ';
        $expect .= 'order_data_client_email, order_data_address_street, order_data_address_zip_code, ';
        $expect .= 'order_data_address_number, order_data_address_complement, order_data_address_district, ';
        $expect .= 'order_data_address_city, order_data_address_state, order_data_address_reference, ';
        $expect .= 'order_data_status, order_data_cart_id, order_data_itens_quantity, order_data_gift_card_code, ';
        $expect .= 'order_data_gift_card_value, order_data_shipping_value, order_data_itens_value, ';
        $expect .= 'order_data_extra_fare_value, order_data_total_value, order_data_shipping_deadline';
        $this->assertEquals($expect, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $params = $this->dao->getParamsStringToInsert();
        $expect = ':code, :clientName, :clientDocumentType, :clientDocument, ';
        $expect .= ':clientMainPhone, :clientSecondPhone, :clientEmail, :addressStreet, ';
        $expect .= ':addressZipCode, :addressNumber, :addressComplement, :addressDistrict, ';
        $expect .= ':addressCity, :addressState, :addressReference, :status, :cartId, ';
        $expect .= ':totalItensQuantity, :giftCardCode, :giftCardValue, :shippingValue, ';
        $expect .= ':itensValue, :extraFareValue, :totalValue, :shippingDeadline';
        $this->assertEquals($expect, $params);
    }

    public function testGetUpdateSting()
    {
        $update = $this->dao->getUpdateSting();
        $expect = 'order_data_code = :code, order_data_client_name = :clientName, ';
        $expect .= 'order_data_client_document_type = :clientDocumentType, ';
        $expect .= 'order_data_client_document = :clientDocument, ';
        $expect .= 'order_data_client_main_phone = :clientMainPhone, ';
        $expect .= 'order_data_client_second_phone = :clientSecondPhone, ';
        $expect .= 'order_data_client_email = :clientEmail, order_data_address_street = :addressStreet, ';
        $expect .= 'order_data_address_zip_code = :addressZipCode, order_data_address_number = :addressNumber, ';
        $expect .= 'order_data_address_complement = :addressComplement, ';
        $expect .= 'order_data_address_district = :addressDistrict, ';
        $expect .= 'order_data_address_city = :addressCity, order_data_address_state = :addressState, ';
        $expect .= 'order_data_address_reference = :addressReference, order_data_status = :status, ';
        $expect .= 'order_data_cart_id = :cartId, order_data_itens_quantity = :totalItensQuantity, ';
        $expect .= 'order_data_gift_card_code = :giftCardCode, order_data_gift_card_value = :giftCardValue, ';
        $expect .= 'order_data_shipping_value = :shippingValue, order_data_itens_value = :itensValue, ';
        $expect .= 'order_data_extra_fare_value = :extraFareValue, order_data_total_value = :totalValue, ';
        $expect .= 'order_data_shipping_deadline = :shippingDeadline';
        $this->assertEquals($expect, $update);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $expect = 'order_data_id = :id';
        $this->assertEquals($expect, $where);
    }
}