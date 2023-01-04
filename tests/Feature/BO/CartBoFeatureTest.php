<?php

namespace tests\Feature\BO;

use PHPUnit\Framework\TestCase;
use src\BO\CartBO;
use src\Database;
use src\Enums\CartEnum;
use src\Enums\FieldsEnum;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\AttributesExceptions\RequiredAttributesMissingException;
use src\Exceptions\ClientExceptions\CartOpenForThisClientException;
use src\Exceptions\FieldsExceptions\InvalidUseForFieldException;
use src\Exceptions\GenericExceptions\NotFoundException;
use tests\Traits\CartItemTraits;
use tests\Traits\CartTraits;
use tests\Traits\GiftCardTraits;

class CartBoFeatureTest extends TestCase
{
    use CartItemTraits, CartTraits, GiftCardTraits;

    public CartBO $bo;

    protected function setUp(): void
    {
        $this->bo = new CartBO();
        $this->deleteOnDbCartItem775And776();
        $this->deleteOnDbGiftCard987();
        $this->insertOnDbCartItem775And776();
        $this->insertOnDbGiftCard987();
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbGiftCard987();
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
        $this->assertFalse($this->bo->validateCartByClientId(741));
        $db = new Database();
        $db->update("UPDATE cart SET cart_order_done = 1 WHERE cart_id = 852");
        $this->assertTrue($this->bo->validateCartByClientId(741));
    }

    public function testValidateClient()
    {
        $this->assertTrue($this->bo->validateClient(741));
        $this->assertFalse($this->bo->validateClient(999999));
    }

    public function testValidatePostParamsApiWithInvalidClient()
    {
        $stdCart = $this->makeStdCartTest852();
        $stdCart->clientId = 99999999;
        $this->expectException(AttributeNotFoundException::class);
        $this->bo->validatePostParamsApi(array('orderDone'), $stdCart);
    }

    public function testValidatePostParamsApiWithCartOpen()
    {
        $stdCart = $this->makeStdCartTest852();
        $this->expectException(CartOpenForThisClientException::class);
        $this->bo->validatePostParamsApi(array('orderDone'), $stdCart);
    }

    public function testValidatePostParamsApiWithInvalidGiftCardId()
    {
        $db = new Database();
        $db->update("UPDATE cart SET cart_order_done = 1 WHERE cart_id = 852");
        $stdCart = $this->makeStdCartTest852();
        $stdCart->giftCardId = 999999;
        $this->expectException(AttributeNotFoundException::class);
        $this->bo->validatePostParamsApi(array('orderDone'), $stdCart);
    }

    public function testValidatePostParamsApiWithExpiredGiftCard()
    {
        $stdCart = $this->makeStdCartTest852();
        $db = new Database();
        $db->update("UPDATE cart SET cart_order_done = 1 WHERE cart_id = 852");
        $db->update("UPDATE gift_card SET gift_card_status = 0 WHERE gift_card_id = 987");
        $this->expectException(InvalidUseForFieldException::class);
        $this->bo->validatePostParamsApi(array('orderDone'), $stdCart);
    }

    public function testValidateGiftCardExistsById()
    {
        $this->assertTrue($this->bo->validateGiftCardExistsById(987));
        $this->assertFalse($this->bo->validateGiftCardExistsById(9999999));
    }

    public function testIsValidGiftCardByIdGiftCardInative()
    {
        $db = new Database();
        $db->update("UPDATE gift_card SET gift_card_status = 0 WHERE gift_card_id = 987");
        $this->assertFalse($this->bo->isValidGiftCardById(987));
    }

    public function testIsValidGiftCardByIdGiftCardMaxUsagesLimit()
    {
        $db = new Database();
        $db->update("UPDATE gift_card SET gift_card_usages = 99 WHERE gift_card_id = 987");
        $this->assertFalse($this->bo->isValidGiftCardById(987));
        $db->update("UPDATE gift_card SET gift_card_usages = 100 WHERE gift_card_id = 987");
        $this->assertFalse($this->bo->isValidGiftCardById(987));
    }

    public function testIsValidGiftCardByIdGiftCardValid()
    {
        $this->assertTrue($this->bo->isValidGiftCardById(987));
    }

    public function testValidatePutParamsApiWithInvalidId()
    {
        $stdCart = $this->makeStdCartTest852();
        $stdCart->id = 999999999999;
        $this->expectException(NotFoundException::class);
        $this->bo->validatePutParamsApi(array(FieldsEnum::ID), $stdCart);
    }

    public function testValidatePutParamsApiWithoutOrderDone()
    {
        $stdCart = $this->makeStdCartTest852();
        unset($stdCart->orderDone);
        $this->expectException(RequiredAttributesMissingException::class);
        $this->bo->validatePutParamsApi(array(FieldsEnum::ID), $stdCart);
    }

    public function testValidatePutParamsApiWithInvalidGiftCardId()
    {
        $stdCart = $this->makeStdCartTest852();
        $stdCart->giftCardId = 9999999;
        $this->expectException(AttributeNotFoundException::class);
        $this->bo->validatePutParamsApi(array(FieldsEnum::ID), $stdCart);
    }

    public function testValidatePutParamsApiWithExpiredGiftCardId()
    {
        $stdCart = $this->makeStdCartTest852();
        $db = new Database();
        $db->update("UPDATE gift_card SET gift_card_status = 0 WHERE gift_card_id = 987");
        $this->expectException(InvalidUseForFieldException::class);
        $this->bo->validatePutParamsApi(array(FieldsEnum::ID), $stdCart);
    }
}