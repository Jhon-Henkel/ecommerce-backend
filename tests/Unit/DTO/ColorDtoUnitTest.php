<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ColorDTO;

class ColorDtoUnitTest extends TestCase
{
    public object $color;

    protected function setUp(): void
    {
        $this->color = new ColorDTO();
    }

    public function testGetterAndSettersColor()
    {
        $this->color->setId(987);
        $this->color->setCode('color-987');
        $this->color->setName('color 987');
        $this->assertEquals(987, $this->color->getId());
        $this->assertEquals('color-987', $this->color->getCode());
        $this->assertEquals('color 987', $this->color->getName());
    }
}