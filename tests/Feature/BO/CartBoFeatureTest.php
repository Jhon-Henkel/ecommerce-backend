<?php

namespace tests\Feature\BO;

use PHPUnit\Framework\TestCase;
use src\BO\CartBO;
use src\Enums\CartEnum;
use tests\Traits\CartItemTraits;
use tests\Traits\CartTraits;

class CartBoFeatureTest extends TestCase
{
    use CartItemTraits, CartTraits;

    public CartBO $bo;

    protected function setUp(): void
    {
        $this->bo = new CartBO();
        $this->deleteOnDbCartItem775And776();
        $this->insertOnDbCartItem775And776();
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbCartItem775And776();
    }

    public function testIGetCartWithStocksPublicByCart()
    {
        $cart = $this->bo->getCartWithStocksPublicByCart($this->makeDtoCartTest852());
        $this->assertInstanceOf(\stdClass::class, $cart);
        $this->assertIsArray($cart->cartItens);
        $this->assertCount(2, $cart->cartItens);
    }

    public function testUpdateCartOrderDone()
    {
        $cart = $this->bo->findById(852);
        $this->assertEquals(CartEnum::ORDER_DONT_DONE, $cart->getOrderDone());
        $this->bo->updateCartOrderDone($cart);
        $cart = $this->bo->findById(852);
        $this->assertEquals(CartEnum::ORDER_DONE, $cart->getOrderDone());
    }

    public function testValidateOrderDone()
    {
        $cart = $this->bo->findById(852);
        $this->assertEquals(CartEnum::ORDER_DONT_DONE, $cart->getOrderDone());
        $this->assertFalse($this->bo->validateOrderDoneByCartId(852));
        $this->bo->updateCartOrderDone($cart);
        $cart = $this->bo->findById(852);
        $this->assertEquals(CartEnum::ORDER_DONE, $cart->getOrderDone());
        $this->assertTrue($this->bo->validateOrderDoneByCartId(852));
    }

    public function testValidateCartClient()
    {
        $this->assertFalse($this->bo->validateCartClient(741));
        $this->assertTrue($this->bo->validateCartClient(999999));
    }

    public function testValidateClient()
    {
        $this->assertTrue($this->bo->validateClient(741));
        $this->assertFalse($this->bo->validateClient(999999));
    }
}