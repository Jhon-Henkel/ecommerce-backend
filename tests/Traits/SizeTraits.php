<?php

namespace tests\Traits;

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

    public function makeStdSizeTest12(): \stdClass
    {
        $size = new \stdClass();
        $size->id = 12;
        $size->name = 'Size Test';
        $size->code = 'size-test-12';
        return $size;
    }
}