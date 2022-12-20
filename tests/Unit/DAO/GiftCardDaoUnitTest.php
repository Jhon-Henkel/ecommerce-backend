<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\GiftCardDAO;
use src\DTO\GiftCardDTO;
use tests\Traits\GiftCardTraits;

class GiftCardDaoUnitTest extends TestCase
{
    use GiftCardTraits;

    public GiftCardDAO $dao;
    public GiftCardDTO $item;

    protected function setUp(): void
    {
        $this->dao = new GiftCardDAO('test_table');
        $this->item = $this->makeDtoGiftCardTest1445();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expected = 'gift_card_code, gift_card_discount_type, gift_card_discount,';
        $expected .= ' gift_card_max_usages, gift_card_status';
        $this->assertEquals($expected, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $this->assertEquals(':code, :type, :discount, :maxUsages, :status', $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('CUPOM100', $paramsArray['code']);
        $this->assertEquals(1, $paramsArray['type']);
        $this->assertEquals(10.45, $paramsArray['discount']);
        $this->assertEquals(99, $paramsArray['maxUsages']);
        $this->assertEquals(1, $paramsArray['status']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expected = 'gift_card_code = :code, gift_card_discount_type = :type, gift_card_discount = :discount,';
        $expected .= ' gift_card_max_usages = :maxUsages, gift_card_status = :status';
        $this->assertEquals($expected, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('gift_card_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('CUPOM100', $paramsArray['code']);
        $this->assertEquals(1, $paramsArray['type']);
        $this->assertEquals(10.45, $paramsArray['discount']);
        $this->assertEquals(99, $paramsArray['maxUsages']);
        $this->assertEquals(1, $paramsArray['status']);
        $this->assertEquals(1234, $paramsArray['id']);
    }
}