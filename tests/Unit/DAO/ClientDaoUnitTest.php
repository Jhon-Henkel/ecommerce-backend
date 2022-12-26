<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\ClientDAO;
use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;
use tests\Traits\ClientTraits;

class ClientDaoUnitTest extends TestCase
{
    use ClientTraits;

    public ClientDAO $dao;
    public ClientDTO $item;

    protected function setUp(): void
    {
        $this->dao = new ClientDAO('test_table');
        $this->item = $this->makeDtoClientTest741();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expect = "client_name, client_document_type, client_document, client_main_phone,";
        $expect .= " client_second_phone, client_email, client_birth_date, client_password";
        $this->assertEquals($expect, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $expect = ':name, :documentType, :document, :mainPhone, :secondPhone, :email, :birthDate, :password';
        $this->assertEquals($expect, $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('Fulaninho da Silva', $paramsArray['name']);
        $this->assertEquals(DocumentEnum::CPF, $paramsArray['documentType']);
        $this->assertEquals('985.785.258-88', $paramsArray['document']);
        $this->assertEquals('(48)99655-4577', $paramsArray['mainPhone']);
        $this->assertEquals('(48)98475-5588', $paramsArray['secondPhone']);
        $this->assertEquals('test@testmail.com', $paramsArray['email']);
        $this->assertEquals('1995-12-10', $paramsArray['birthDate']);
        $this->assertEquals('12345678', $paramsArray['password']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expect = "client_name = :name, client_document_type = :documentType, client_document = :document,";
        $expect .= " client_main_phone = :mainPhone, client_second_phone = :secondPhone,";
        $expect .= " client_email = :email, client_birth_date = :birthDate, client_password = :password";
        $this->assertEquals($expect, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('client_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(741, $paramsArray['id']);
        $this->assertEquals('Fulaninho da Silva', $paramsArray['name']);
        $this->assertEquals(DocumentEnum::CPF, $paramsArray['documentType']);
        $this->assertEquals('985.785.258-88', $paramsArray['document']);
        $this->assertEquals('(48)99655-4577', $paramsArray['mainPhone']);
        $this->assertEquals('(48)98475-5588', $paramsArray['secondPhone']);
        $this->assertEquals('test@testmail.com', $paramsArray['email']);
        $this->assertEquals('1995-12-10', $paramsArray['birthDate']);
        $this->assertEquals('12345678', $paramsArray['password']);
    }
}