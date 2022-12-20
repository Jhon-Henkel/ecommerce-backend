<?php

namespace tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use src\BO\GiftCardBO;
use src\Controllers\GiftCardController;
use src\Factory\GiftCardDtoFactory;

class GiftCardControllerUnitTest extends TestCase
{
    public function testCallGiftCardController()
    {
        $controller = new GiftCardController();
        $this->assertInstanceOf(GiftCardBO::class, $controller->bo);
        $this->assertInstanceOf(GiftCardDtoFactory::class, $controller->factory);
        $this->assertIsArray($controller->fieldsToValidate);
    }
}