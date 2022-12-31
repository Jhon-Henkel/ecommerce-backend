<?php

namespace tests\Feature\BO;

use PHPUnit\Framework\TestCase;
use src\BO\ShippingBO;
use src\Database;
use src\DTO\ShippingCalculatedDTO;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Exceptions\ShippingExceptions\InvalidParamCalculateException;
use tests\Traits\CartItemTraits;

class ShippingBoFeatureTest extends TestCase
{
    use CartItemTraits;

    public ShippingBO $bo;
    public int $cartId;

    protected function setUp(): void
    {
        $this->bo = new ShippingBO();
        $this->cartId = 852;
        $this->deleteOnDbCartItem775And776();
        $this->insertOnDbCartItem775And776();
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbCartItem775And776();
    }

    public function testCalculateShippingCartByCartIdWithInvalidCartId()
    {
        $this->expectException(NotFoundException::class);
        $this->bo->calculateShippingCartByCartId(999999, '88750000');
    }

    public function testCalculateShippingCartByCartIdWithValidCartId()
    {
        $calc = $this->bo->calculateShippingCartByCartId($this->cartId, '88750000');
        $this->assertIsArray($calc);
        $this->assertCount(2, $calc);
        $this->assertInstanceOf(ShippingCalculatedDTO::class, $calc[0]);
        $this->assertInstanceOf(ShippingCalculatedDTO::class, $calc[1]);
    }

    public function testCalculateShippingCartByCartIdInvalidParametersShippingCorreios()
    {
        $db = new Database();
        $query = "UPDATE product_stock SET product_stock_gross_weight = 50 WHERE product_stock_id = 75";
        $db->update($query);
        $calc = $this->bo->calculateShippingCartByCartId($this->cartId, '88750000');
        $this->assertIsArray($calc);
        $this->assertArrayHasKey('Correios', $calc);
        $this->assertEquals('Parâmetros inválidos!', $calc['Correios']);
    }

    public function testCalculateShippingCartByCartIdWithInvalidZipCode()
    {
        $calc = $this->bo->calculateShippingCartByCartId($this->cartId, '00000000');
        $this->assertIsArray($calc);
        $this->assertArrayHasKey('Correios', $calc);
        $this->assertEquals('Correios não conseguiu fazer o cálculo!', $calc['Correios']);
    }
}