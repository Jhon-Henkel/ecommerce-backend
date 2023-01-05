<?php

namespace tests\Feature\BO;

use PHPUnit\Framework\TestCase;
use src\BO\SizeBO;
use src\Database;
use src\DTO\SizeDTO;
use src\Exceptions\AttributesExceptions\RequiredAttributesMissingException;
use src\Exceptions\FieldsExceptions\InvalidFieldValueException;
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
        $item = $this->makeStdSizeTest12();
        $this->bo->validateFieldsExist(array('code', 'name'), $item);
        $this->assertTrue(true);
        $this->expectException(RequiredAttributesMissingException::class);
        $this->bo->validateFieldsExist(array('code', 'name', 'test'), $item);
    }

    public function testInvalidFieldValue()
    {
        $item = $this->makeStdSizeTest12();
        $this->expectException(InvalidFieldValueException::class);
        $item->code = '';
        $this->bo->validateFieldsExist(array('code', 'name'), $item);
    }

    public function testDeleteById()
    {
        $db = new Database();
        $before = $db->selectCount("SELECT * FROM size WHERE size_id = 999999");
        $this->assertEquals(1, $before);
        $this->bo->deleteById(999999);
        $after = $db->selectCount("SELECT * FROM size WHERE size_id = 999999");
        $this->assertEquals(0, $after);
    }

    public function testFindById()
    {
        $find = $this->bo->findById(999999);
        $this->assertInstanceOf(SizeDTO::class, $find);
        $findNull = $this->bo->findById(123456789);
        $this->assertNull($findNull);
    }

    public function testCountById()
    {
        $count = $this->bo->countById(999999);
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
        $this->assertEquals(999999, $last->getId());
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
        $db->insert("INSERT INTO size (size_id, size_name, size_code) VALUES (999999, 'FIELD_NAME', 'FIELD_code')");
    }

    public function deleteSizeForTest()
    {
        $db = new Database();
        $db->delete("DELETE FROM size WHERE size_id = 999999");
        $db->delete("DELETE FROM size WHERE size_code = 'size-test-12'");
    }
}