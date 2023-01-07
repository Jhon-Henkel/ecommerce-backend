<?php

namespace tests\Feature\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\CartItemDAO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use tests\Traits\CartItemTraits;

class CartItemDaoFeatureTest extends TestCase
{
    use CartItemTraits;

    public CartItemDAO $dao;

    protected function setUp(): void
    {
        $this->deleteOnDbCartItem775And776();
        $this->dao = new CartItemDAO(TableEnum::CART_ITEM);
        $this->insertOnDbCartItem775And776();
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbCartItem775And776();
    }

    public function testFindAllByCartId(): void
    {
        $cartItem = $this->dao->findAllByCartId(852);
        $this->assertCount(2, $cartItem);
        $cartItem = $this->dao->findAllByCartId(999999);
        $this->assertCount(0, $cartItem);
    }

    public function testDeleteByCartId()
    {
        $cartItem = $this->dao->findAllByCartId(852);
        $this->assertCount(2, $cartItem);
        $this->dao->deleteByCartId(852);
        $cartItem = $this->dao->findAllByCartId(852);
        $this->assertCount(0, $cartItem);
    }

    public function testCountByColumnValueWithCartId()
    {
        $cartItem = $this->dao->countByColumnValueWithCartId(FieldsEnum::STOCK_ID_DB, 74, 852);
        $this->assertEquals(1, $cartItem);
        $cartItem = $this->dao->countByColumnValueWithCartId(FieldsEnum::STOCK_ID_DB, 999, 852);
        $this->assertEquals(0, $cartItem);
    }

    public function testFindAllByStockId()
    {
        $cartItens = $this->dao->findAllByStockId(74);
        $this->assertCount(1, $cartItens);
        $cartItens = $this->dao->findAllByStockId(9999999);
        $this->assertCount(0, $cartItens);
    }

    public function testDeleteByStockId()
    {
        $cartItens = $this->dao->findAllByStockId(74);
        $this->assertCount(1, $cartItens);
        $this->dao->deleteByStockId(74);
        $cartItens = $this->dao->findAllByStockId(74);
        $this->assertCount(0, $cartItens);
    }
}