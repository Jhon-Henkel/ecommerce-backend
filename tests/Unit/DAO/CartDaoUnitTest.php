<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\CartDAO;
use src\DTO\CartDTO;
use tests\Traits\CartTraits;

class CartDaoUnitTest extends TestCase
{
    use CartTraits;

    public CartDAO $dao;
    public CartDTO $item;

    protected function setUp(): void
    {
        $this->dao = new CartDAO('test_table');
        $this->item = $this->makeDtoCartTest852();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expect = 'cart_client_id, cart_hash, cart_gift_card_id, cart_order_done';
        $this->assertEquals($expect, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $expect = ':client, :hash, :giftCard, :orderDone';
        $this->assertEquals($expect, $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(777, $paramsArray['client']);
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $paramsArray['hash']);
        $this->assertEquals(987, $paramsArray['giftCard']);
        $this->assertEquals(1, $paramsArray['orderDone']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expect = 'cart_client_id = :client, cart_hash = :hash,';
        $expect .= ' cart_gift_card_id = :giftCard, cart_order_done = :orderDone';
        $this->assertEquals($expect, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('cart_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(852, $paramsArray['id']);
        $this->assertEquals(777, $paramsArray['client']);
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $paramsArray['hash']);
        $this->assertEquals(987, $paramsArray['giftCard']);
        $this->assertEquals(1, $paramsArray['orderDone']);
    }
}