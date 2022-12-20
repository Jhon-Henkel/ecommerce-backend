<?php

namespace tests\Feature;

use PHPUnit\Framework\TestCase;
use src\Database;
use src\Exceptions\DatabaseExceptions\QueryTypeException;

class DatabaseFeatureTest extends TestCase
{
    public Database $db;

    protected function setUp(): void
    {
        $this->db = new Database();
        $this->deleteTestRegistry();
        $this->insertTestRegistry();
    }

    protected function tearDown(): void
    {
        $this->deleteTestRegistry();
    }

    public function testInvalidSelect()
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo SELECT');
        $this->db->select("UPDATE ....");
    }

    public function testValidSelect()
    {
        $data = $this->db->select("SELECT * FROM color WHERE color_id = '999999'");
        $this->assertCount(1, $data);
    }

    public function testInvalidCountSelect()
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo SELECT');
        $this->db->selectCount("UPDATE ....");
    }

    public function testValidCountSelect()
    {
        $data = $this->db->selectCount("SELECT * FROM color WHERE color_id = '999999'");
        $this->assertEquals(1, $data);
    }

    public function testInvalidInsert()
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo INSERT');
        $this->db->insert("DELETE ....");
    }

    public function testValidInsert()
    {
        $params = array('name' => 'FIELD_NAME_2', 'code' => 'FIELD_CODE_2', 'id' => 999998);
        $this->db->insert("INSERT INTO color (color_id, color_code, color_name) VALUES (:id, :name, :code)", $params);
        $data = $this->db->selectCount("SELECT * FROM color WHERE color_id = '999998'");
        $this->assertEquals(1, $data);
    }

    public function testInvalidUpdate()
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo UPDATE');
        $this->db->update("TRUNCATE ....");
    }

    public function testValidUpdate()
    {
        $params = array('name' => 'FIELD_NAME_UPDATED', 'code' => 'FIELD_CODE_UPDATED', 'id' => 999999);
        $this->db->update("UPDATE color SET color_name = :name, color_code = :code WHERE color_id = :id", $params);
        $data = $this->db->selectCount("SELECT * FROM color WHERE color_name = 'FIELD_NAME_UPDATED'");
        $this->assertEquals(1, $data);
    }

    public function testInvalidDelete()
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo DELETE');
        $this->db->delete("SELECT ....");
    }

    public function testValidDelete()
    {
        $this->db->delete("DELETE FROM color WHERE color_id = '999999'");
        $data = $this->db->selectCount("SELECT * FROM color WHERE color_id = '999999'");
        $this->assertEquals(0, $data);

    }

    public function insertTestRegistry()
    {
        $params = array('name' => 'FIELD_NAME', 'code' => 'FIELD_CODE', 'id' => 999999);
        $this->db->insert("INSERT INTO color (color_id, color_code, color_name) VALUES (:id, :name, :code)", $params);
    }

    public function deleteTestRegistry()
    {
        $this->db->delete("DELETE FROM color WHERE color_id = :id", array('id' => 999998));
        $this->db->delete("DELETE FROM color WHERE color_id = :id", array('id' => 999999));
    }
}