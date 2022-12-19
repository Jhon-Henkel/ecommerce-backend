<?php

namespace tests\Traits;

use src\DTO\ColorDTO;

trait ColorTraits
{
    public function makeDtoColorTest95(): ColorDTO
    {
        $color = new ColorDTO();
        $color->setId(95);
        $color->setName('Color Test');
        $color->setCode('color-test-95');
        return $color;
    }

    public function makeDtoColorTest96(): ColorDTO
    {
        $color = new ColorDTO();
        $color->setId(96);
        $color->setName('Color Test 96');
        $color->setCode('color-test-96');
        return $color;
    }

    public function makeStdColorTest95(): \stdClass
    {
        $color = new \stdClass();
        $color->id = 95;
        $color->name = 'Color Test';
        $color->code = 'color-test-95';
        return $color;
    }

    public function makeStdColorTest96(): \stdClass
    {
        $color = new \stdClass();
        $color->id = 96;
        $color->name = 'Color Test 96';
        $color->code = 'color-test-96';
        return $color;
    }
}