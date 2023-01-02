<?php

namespace tests\Feature\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\SizeDAO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use tests\Traits\SizeTraits;

class BasicDaoFeatureTest extends TestCase
{
    use SizeTraits;

    private SizeDAO $dao;

    protected function setUp(): void
    {
        $this->deleteOnDbSize12();
        $this->insertOnDbSize12();
        $this->dao = new SizeDAO(TableEnum::SIZE);
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbSize12();
    }

    public function testFindByCode()
    {
        $size = $this->dao->findByCode('size-test-12');
        $this->assertIsArray($size);
        $this->assertCount(1, $size);
    }

    public function testFindByName()
    {
        $size = $this->dao->findByName('Size Test');
        $this->assertIsArray($size);
        $this->assertCount(1, $size);
    }

    public function testFindByCodeExceptId()
    {
        $size = $this->dao->findByCodeExceptId('size-test-12', 147);
        $this->assertIsArray($size);
        $this->assertCount(1, $size);
        $size = $this->dao->findByCodeExceptId('size-test-12', 12);
        $this->assertIsArray($size);
        $this->assertCount(0, $size);
    }

    public function testFindByNameExceptId()
    {
        $size = $this->dao->findByNameExceptId('Size Test', 147);
        $this->assertIsArray($size);
        $this->assertCount(1, $size);
        $size = $this->dao->findByCodeExceptId('Size Test', 12);
        $this->assertIsArray($size);
        $this->assertCount(0, $size);
    }

    public function testCountByColumnValueExceptId()
    {
        $size = $this->dao->countByColumnValueExceptId(FieldsEnum::CODE, 'size-test-12', 147);
        $this->assertEquals(1, $size);
        $size = $this->dao->countByColumnValueExceptId(FieldsEnum::CODE, 'size-test-12', 12);
        $this->assertEquals(0, $size);
    }
}