<?php

namespace tests\Traits;

use src\Database;
use src\DTO\SizeDTO;
use stdClass;

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

    public function makeStdSizeTest12(): stdClass
    {
        $size = new stdClass();
        $size->id = 12;
        $size->name = 'Size Test';
        $size->code = 'size-test-12';
        return $size;
    }

    public function makeStdSizeTest13(): stdClass
    {
        $size = new stdClass();
        $size->id = 13;
        $size->name = 'Size Test 13';
        $size->code = 'size-test-13';
        return $size;
    }

    public function makeStdSizeTest14(): stdClass
    {
        $size = new stdClass();
        $size->id = 14;
        $size->name = 'Size Test 14';
        $size->code = 'size-test-14';
        return $size;
    }

    public function insertOnDbSize12()
    {
        $db = new Database();
        $db->insert("INSERT INTO size (size_id, size_name, size_code) VALUES (12, 'Size Test', 'size-test-12')");
    }

    public function deleteOnDbSize12()
    {
        $db = new Database();
        $db->delete("DELETE FROM size WHERE size_id = 12");
    }
}