<?php

namespace src\DAO;

use src\Database;

abstract class BasicDAO
{
    public string $table;
    public Database $database;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->database = new Database();
    }

    public function insert(string $columns, string $values, array $params = []): void
    {
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $this->database->insert($query, $params);
    }

    public function update(string $values, string $where, array $params = []): void
    {
        $query = "UPDATE $this->table SET $values WHERE $where";
        $this->database->update($query, $params);
    }

    public function findLastInserted(): array
    {
        $query = "SELECT * FROM $this->table ORDER BY " . $this->table . "_id DESC limit 1";
        $result = $this->database->select($query);
        return reset($result);
    }

    public function findById(int $id): bool|array
    {
        $result = $this->database->select(
            "SELECT * FROM $this->table WHERE " . $this->table . "_id = :id",
            array('id' => $id)
        );
        return reset($result);
    }

    public function findByCode(string $code): bool|array
    {
        return $this->database->select(
            "SELECT * FROM $this->table WHERE " . $this->table . "_code = :code",
            array('code' => $code)
        );
    }

    public function findByName(string $name): bool|array
    {
        return $this->database->select(
            "SELECT * FROM $this->table WHERE " . $this->table . "_name = :name",
            array('name' => $name)
        );
    }

    public function findByNameExceptId(string $name, int $id): bool|array
    {
        $query = "SELECT * FROM $this->table ";
        $query .= "WHERE " . $this->table . "_name = :name ";
        $query .= "AND " . $this->table . "_id NOT IN (:id)";
        return $this->database->select($query, array('name' => $name, 'id' => $id));
    }

    public function findByCodeExceptId(string $code, int $id): bool|array
    {
        $query = "SELECT * FROM $this->table ";
        $query .= "WHERE " . $this->table . "_code = :code ";
        $query .= "AND " . $this->table . "_id NOT IN (:id)";
        return $this->database->select($query, array('code' => $code, 'id' => $id));
    }

    public function deleteById(int $id): void
    {
        $query = "DELETE FROM $this->table WHERE " . $this->table . "_id = :id";
        $this->database->delete($query, array('id' => $id));
    }

    public function findAll(): array
    {
        return $this->database->select("SELECT * FROM $this->table");
    }
}