<?php

namespace tests\Unit\Factory;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use src\DTO\CartDTO;
use src\Factory\CartDtoFactory;
use tests\Traits\CartTraits;
use src\Tools\DateTools;

class cartDtoFactoryUnitTest extends TestCase
{
    use CartTraits;

    public \stdClass $stdItem;
    public CartDTO $dtoItem;
    public array $dbItem;
    public CartDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdItem = $this->makeStdCartTest852();
        $this->dtoItem = $this->makeDtoCartTest852();
        $this->dbItem = $this->makeDbCartTest852();
        $this->factory = new CartDtoFactory();
    }

    public function testFactory(): void
    {
        $item = $this->factory->factory($this->stdItem);
        $this->assertInstanceOf(CartDTO::class, $item);
        $this->assertInstanceOf(DateTime::class, $item->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $item->getUpdatedAt());
        $this->assertEquals(777, $item->getClientId());
        $this->assertEquals(852, $item->getId());
        $this->assertEquals(1, $item->getOrderDone());
        $this->assertEquals(987, $item->getGiftCardId());
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $item->getHash());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($item->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($item->getUpdatedAt()));
    }

    public function testMakePublic(): void
    {
        $item = $this->factory->makePublic($this->dtoItem);
        $this->assertInstanceOf(\stdClass::class, $item);
        $this->assertEquals(777, $item->clientId);
        $this->assertEquals(852, $item->id);
        $this->assertEquals(1, $item->orderDone);
        $this->assertEquals(987, $item->giftCardId);
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $item->hash);
        $this->assertEquals('2022-10-01', $item->createdAt);
        $this->assertEquals('2022-11-10', $item->updatedAt);
    }

    public function testMergeObjectDbWitchObjectPut(): void
    {
        $this->assertEquals(1, $this->dtoItem->getOrderDone());
        $put = new \stdClass();
        $put->orderDone = 0;
        $item = $this->factory->mergeObjectDbWitchObjectPut($this->dtoItem, $put);
        $this->assertInstanceOf(CartDTO::class, $item);
        $this->assertInstanceOf(DateTime::class, $item->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $item->getUpdatedAt());
        $this->assertEquals(777, $item->getClientId());
        $this->assertEquals(852, $item->getId());
        $this->assertEquals(0, $item->getOrderDone());
        $this->assertEquals(987, $item->getGiftCardId());
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $item->getHash());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($item->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($item->getUpdatedAt()));
    }

    /**
     * @throws Exception
     */
    public function testPopulateDbToDto(): void
    {
        $item = $this->factory->populateDbToDto($this->dbItem);
        $this->assertInstanceOf(CartDTO::class, $item);
        $this->assertInstanceOf(DateTime::class, $item->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $item->getUpdatedAt());
        $this->assertEquals(777, $item->getClientId());
        $this->assertEquals(852, $item->getId());
        $this->assertEquals(1, $item->getOrderDone());
        $this->assertEquals(987, $item->getGiftCardId());
        $this->assertEquals('098f6bcd4621d373cade4e832627b4f6', $item->getHash());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($item->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($item->getUpdatedAt()));




    }
}