<?php

namespace tests\Unit\Traits;

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
}