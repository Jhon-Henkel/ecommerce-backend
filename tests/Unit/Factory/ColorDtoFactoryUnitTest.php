<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\ColorDTO;
use src\Factory\ColorDtoFactory;

class ColorDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdColor;
    public ColorDTO $dtoColor;
    public array $dbColor;
    public ColorDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdColor = $this->makeStdColor();
        $this->dtoColor = $this->makeDtoColor();
        $this->dbColor = $this->makeArrayColorDb();
        $this->factory = new ColorDtoFactory();
    }

    public function testMakePublic()
    {
        $publicColor = $this->factory->makePublic($this->dtoColor);
        $this->assertInstanceOf(\stdClass::class, $publicColor);
        $this->assertEquals(785, $publicColor->id);
        $this->assertEquals('unit test dto color', $publicColor->name);
        $this->assertEquals('unit-test-dto-color', $publicColor->code);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdColor);
        $this->assertInstanceOf(ColorDTO::class, $factored);
        $this->assertEquals(785, $factored->getId());
        $this->assertEquals('unit test std color', $factored->getName());
        $this->assertEquals('unit-test-std-color', $factored->getCode());
    }

    public function testPopulateDbToDto()
    {
        $color = $this->factory->populateDbToDto($this->dbColor);
        $this->assertInstanceOf(ColorDTO::class, $color);
        $this->assertEquals(785, $color->getId());
        $this->assertEquals('Color Test', $color->getName());
        $this->assertEquals('color-test', $color->getCode());
    }

    public function makeStdColor(): \stdClass
    {
        $color = new \stdClass();
        $color->id = 785;
        $color->name = 'unit test std color';
        $color->code = 'unit-test-std-color';
        $color->createdAt = null;
        $color->updatedAt = null;
        return $color;
    }

    public function makeDtoColor(): ColorDTO
    {
        $color = new ColorDTO();
        $color->setId(785);
        $color->setName('unit test dto color');
        $color->setCode('unit-test-dto-color');
        $color->setCreatedAt(null);
        $color->setUpdatedAt(null);
        return $color;
    }

    public function makeArrayColorDb(): array
    {
        $item = array();
        $item['color_id'] = 785;
        $item['color_name'] = 'Color Test';
        $item['color_code'] = 'color-test';
        $item['color_created_at'] = null;
        $item['color_updated_at'] = null;
        return $item;
    }
}
