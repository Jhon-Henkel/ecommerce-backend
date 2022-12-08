<?php

namespace src\DAO;

use src\Database;
use src\DTO\BrandDTO;

class BrandDAO
{
    public function insert(BrandDTO $brand): void
    {
        $database = new Database();
        $query = "INSERT INTO brand (brand_code, brand_name) VALUES (:code, :name)";
        $params = array('code' => $brand->getCode(), 'name' => $brand->getName());
        $database->insert($query, $params);
    }

    public function update(BrandDTO $brand): void
    {
        $database = new Database();
        $query = "UPDATE brand SET brand_code = :code, brand_name = :name WHERE brand_id = :id";
        $params = array('code' => $brand->getCode(), 'name' => $brand->getName(), 'id' => $brand->getId());
        $database->update($query, $params);
    }

    public function findByName(string $name): bool|array
    {
        $database = new Database();
        return $database->select("SELECT * FROM brand WHERE brand_name = :name", array('name' => $name));
    }

    public function findByCode(string $code): bool|array
    {
        $database = new Database();
        return $database->select("SELECT * FROM brand WHERE brand_code = :code", array('code' => $code));
    }

    public function findById(int $id): bool|array
    {
        $database = new Database();
        $result = $database->select("SELECT * FROM brand WHERE brand_id = :id", array('id' => $id));
        return reset($result);
    }

    public function findByNameExceptId(string $name, int $id): bool|array
    {
        $database = new Database();
        $query = "SELECT * FROM brand WHERE brand_name = :name AND brand_id NOT IN (:id)";
        return $database->select($query, array('name' => $name, 'id' => $id));
    }

    public function findByCodeExceptId(string $code, int $id): bool|array
    {
        $database = new Database();
        $query = "SELECT * FROM brand WHERE brand_code = :code AND brand_id NOT IN (:id)";
        return $database->select($query, array('code' => $code, 'id' => $id));
    }

    public function findLastInserted(): array
    {
        $database = new Database();
        $query = "SELECT * FROM brand ORDER BY brand_id DESC limit 1";
        $result = $database->select($query);
        return reset($result);
    }
}