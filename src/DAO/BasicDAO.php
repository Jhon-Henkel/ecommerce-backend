<?php

namespace src\DAO;

use src\Database;

class BasicDAO
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
}