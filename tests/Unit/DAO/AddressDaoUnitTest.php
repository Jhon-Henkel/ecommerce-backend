<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\AddressDAO;
use src\DTO\AddressDTO;
use tests\Traits\AddressTraits;

class AddressDaoUnitTest extends TestCase
{
    use AddressTraits;

    public AddressDAO $dao;
    public AddressDTO $item;

    protected function setUp(): void
    {
        $this->dao = new AddressDAO('test_table');
        $this->item = $this->makeDtoAddressTest1234();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expect = 'address_client_id, address_street, address_zip_code, address_number,';
        $expect .= ' address_complement, address_district, address_city, address_state, address_reference';
        $this->assertEquals($expect, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $expect = ':clientId, :street, :zip, :number, :complement, :district, :city, :state, :reference';
        $this->assertEquals($expect, $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(899, $paramsArray['clientId']);
        $this->assertEquals('Street', $paramsArray['street']);
        $this->assertEquals('88780-000', $paramsArray['zip']);
        $this->assertEquals(88, $paramsArray['number']);
        $this->assertEquals('Complement', $paramsArray['complement']);
        $this->assertEquals('District', $paramsArray['district']);
        $this->assertEquals('City', $paramsArray['city']);
        $this->assertEquals('State', $paramsArray['state']);
        $this->assertEquals('Reference', $paramsArray['reference']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expect = 'address_client_id = :clientId, address_street = :street, address_zip_code = :zip,';
        $expect .= ' address_number = :number, address_complement = :complement, address_district = :district,';
        $expect .= ' address_city = :city, address_state = :state, address_reference = :reference';
        $this->assertEquals($expect, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('address_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(1234, $paramsArray['id']);
        $this->assertEquals(899, $paramsArray['clientId']);
        $this->assertEquals('Street', $paramsArray['street']);
        $this->assertEquals('88780-000', $paramsArray['zip']);
        $this->assertEquals(88, $paramsArray['number']);
        $this->assertEquals('Complement', $paramsArray['complement']);
        $this->assertEquals('District', $paramsArray['district']);
        $this->assertEquals('City', $paramsArray['city']);
        $this->assertEquals('State', $paramsArray['state']);
        $this->assertEquals('Reference', $paramsArray['reference']);
    }
}