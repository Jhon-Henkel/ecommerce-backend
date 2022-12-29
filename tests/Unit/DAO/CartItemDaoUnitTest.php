<?php

namespace tests\Unit\DAO;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use src\DAO\CartItemDAO;
use src\DTO\CartItemDTO;
use tests\Traits\CartItemTraits;
use src\Tools\DateTools;

class CartItemDaoUnitTest extends TestCase
{
    use CartItemTraits;

    public CartItemDAO $dao;

    protected function setUp(): void
    {
        $this->dao = new CartItemDAO('test_table');
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expect = 'cart_item_cart_id, cart_item_stock_id, cart_item_quantity';
        $this->assertEquals($expect, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $params = $this->dao->getParamsStringToInsert();
        $expect = ':cartId, :stockId, :quantity';
        $this->assertEquals($expect, $params);
    }

    public function testGetUpdateSting()
    {
        $update = $this->dao->getUpdateSting();
        $expect = 'cart_item_cart_id = :cartId, cart_item_stock_id = :stockId, cart_item_quantity = :quantity';
        $this->assertEquals($expect, $update);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $expect = 'cart_item_id = :id';
        $this->assertEquals($expect, $where);
    }

    /**
     * @throws Exception
     */
    public function testGetParamsArrayToInsert()
    {
        $item = $this->dao->getParamsArrayToInsert($this->makeDtoCartItem775());
        $this->assertEquals(852, $item['cartId']);
        $this->assertEquals(12, $item['quantity']);
        $this->assertEquals(74, $item['stockId']);
    }

    /**
     * @throws Exception
     */
    public function testGetParamsArrayToUpdate()
    {
        $item = $this->dao->getParamsArrayToUpdate($this->makeDtoCartItem775());
        $this->assertEquals(775, $item['id']);
        $this->assertEquals(852, $item['cartId']);
        $this->assertEquals(12, $item['quantity']);
        $this->assertEquals(74, $item['stockId']);
    }
}