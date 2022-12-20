<?php

namespace tests\Feature\BO;

use PHPUnit\Framework\TestCase;
use src\BO\SizeBO;
use src\Database;
use src\DTO\SizeDTO;
use tests\Traits\SizeTraits;

class BasicBoFeatureTest extends TestCase
{
    use SizeTraits;

    public SizeBO $bo;

    protected function setUp(): void
    {
        $this->bo = new SizeBO();
        $this->deleteSizeForTest();
        $this->insertSizeForTest();
    }

    protected function tearDown(): void
    {
        $this->deleteSizeForTest();
    }

    public function testValidateFieldsExist()
    {
        $this->bo->validateFieldsExist(array('code', 'name'), $this->makeStdSizeTest12());
        $this->assertTrue(true);
    }

    public function testDeleteById()
    {
        $db = new Database();
        $before = $db->selectCount("SELECT * FROM size WHERE size_id = 1234");
        $this->assertEquals(1, $before);
        $this->bo->deleteById(1234);
        $after = $db->selectCount("SELECT * FROM size WHERE size_id = 1234");
        $this->assertEquals(0, $after);
    }

    public function testFindById()
    {
        $find = $this->bo->findById(1234);
        $this->assertInstanceOf(SizeDTO::class, $find);
        $findNull = $this->bo->findById(123456789);
        $this->assertNull($findNull);
    }

    public function testCountById()
    {
        $count = $this->bo->countById(1234);
        $this->assertEquals(1, $count);
        $countZero = $this->bo->countById(123456789);
        $this->assertEquals(0, $countZero);
    }

    public function testFindAll()
    {
        $find = $this->bo->findAll();
        $this->assertIsArray($find);
    }

    public function testFindLastInserted()
    {
        $last = $this->bo->findLastInserted();
        $this->assertInstanceOf(SizeDTO::class, $last);
        $this->assertEquals(1234, $last->getId());
    }

    public function testValidatePostParamsApi()
    {
        $this->bo->validatePostParamsApi(array('code', 'name'), $this->makeStdSizeTest12());
        $this->assertTrue(true);
    }

    public function testInsert()
    {
        $db = new Database();
        $countAfter = $db->selectCount("SELECT * FROM size WHERE size_code = 'size-test-12'");
        $this->assertEquals(0, $countAfter);
        $this->bo->insert($this->makeDtoSizeTest12());
        $countAfter = $db->selectCount("SELECT * FROM size WHERE size_code = 'size-test-12'");
        $this->assertEquals(1, $countAfter);
    }

    public function testUpdate()
    {
        $item = $this->bo->findLastInserted();
        $item->setName('testUpdate');
        $this->bo->update($item);
        $afterInsert = $this->bo->findById($item->getId());
        $this->assertEquals('testUpdate', $afterInsert->getName());
    }

    public function insertSizeForTest()
    {
        $db = new Database();
        $db->insert("INSERT INTO size (size_id, size_name, size_code) VALUES (1234, 'FIELD_NAME', 'FIELD_code')");
    }

    public function deleteSizeForTest()
    {
        $db = new Database();
        $db->delete("DELETE FROM size WHERE size_id = 1234");
        $db->delete("DELETE FROM size WHERE size_code = 'size-test-12'");
    }
}