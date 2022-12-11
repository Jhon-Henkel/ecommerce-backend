<?php

namespace tests\Unit\Traits;

use src\DTO\SizeDTO;

trait SizeTraits
{
    public function makeDtoSizeTest12(): SizeDTO
    {
        $size = new SizeDTO();
        $size->setId(12);
        $size->setName('Size Test');
        $size->setCode('size-test-12');
        return $size;
    }
}