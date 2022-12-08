<?php

namespace src\DAO;

use src\Database;
use src\DTO\BrandDTO;

class BrandDAO
{
    public function insert(BrandDTO $brand): bool
    {
        $database = new Database();
        $query = "INSERT INTO brand (brand_code, brand_name) VALUES (:code, :name)";
        $params = array('code' => $brand->getCode(), 'name' => $brand->getName());
        $database->insert($query, $params);
        return true;
    }

    public function findByName(string $name): ?array
    {
        $database = new Database();
        return $database->select("SELECT * FROM brand WHERE brand_name = :name", array('name' => $name));
    }

    public function findByCode(string $code): ?array
    {
        $database = new Database();
        return $database->select("SELECT * FROM brand WHERE brand_code = :code", array('code' => $code));
    }
}