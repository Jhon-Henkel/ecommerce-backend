<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\SizeDTO;
use src\Factory\SizeDtoFactory;

class SizeDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdSize;
    public SizeDTO $dtoSize;
    public array $dbSize;
    public SizeDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdSize = $this->makeStdSize();
        $this->dtoSize = $this->makeDtoSize();
        $this->dbSize = $this->makeArraySizeDb();
        $this->factory = new SizeDtoFactory();
    }

    public function testMakePublic()
    {
        $publicSize = $this->factory->makePublic($this->dtoSize);
        $this->assertInstanceOf(\stdClass::class, $publicSize);
        $this->assertEquals(785, $publicSize->id);
        $this->assertEquals('unit test dto size', $publicSize->name);
        $this->assertEquals('unit-test-dto-size', $publicSize->code);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdSize);
        $this->assertInstanceOf(SizeDTO::class, $factored);
        $this->assertEquals(785, $factored->getId());
        $this->assertEquals('unit test std size', $factored->getName());
        $this->assertEquals('unit-test-std-size', $factored->getCode());
    }

    public function testPopulateDbToDto()
    {
        $size = $this->factory->populateDbToDto($this->dbSize);
        $this->assertInstanceOf(SizeDTO::class, $size);
        $this->assertEquals(785, $size->getId());
        $this->assertEquals('Size Test', $size->getName());
        $this->assertEquals('size-test', $size->getCode());
    }

    public function makeStdSize(): \stdClass
    {
        $size = new \stdClass();
        $size->id = 785;
        $size->name = 'unit test std size';
        $size->code = 'unit-test-std-size';
        return $size;
    }

    public function makeDtoSize(): SizeDTO
    {
        $size = new SizeDTO();
        $size->setId(785);
        $size->setName('unit test dto size');
        $size->setCode('unit-test-dto-size');
        return $size;
    }

    public function makeArraySizeDb(): array
    {
        $item = array();
        $item['size_id'] = 785;
        $item['size_name'] = 'Size Test';
        $item['size_code'] = 'size-test';
        return $item;
    }
}