<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CategoryDAO;
use src\DTO\CategoryDTO;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\CategoryDtoFactory;

class CategoryBO extends BasicBO
{
    public CategoryDAO $dao;
    public CategoryDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new CategoryDAO('category');
        $this->factory = new CategoryDtoFactory();
    }

    public function insert(CategoryDTO $category): void
    {
        $columns = 'category_code, category_name, category_father_id';
        $values = ':code, :name, :fatherId';
        $params = array(
            'code' => $category->getCode(),
            'name' => $category->getName(),
            'fatherId' => $category->getFatherId()
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(CategoryDTO $category)
    {
        $values = 'category_code = :code, category_name = :name, category_father_id = :fatherId';
        $where = 'category_id = :id';
        $params = array(
            'id' => $category->getId(),
            'code' => $category->getCode(),
            'name' => $category->getName(),
            'fatherId' => $category->getFatherId()
        );
        $this->dao->update($values, $where, $params);
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $object): void
    {
        parent::validatePostParamsApi($paramsFields, $object);
        if (
            isset($object->fatherId)
            && !$this->dao->findById($object->fatherId)
        ) {
            Response::Render(HttpStatusCodeEnum::HTTP_NOT_FOUND, 'Categoria pai não encontrada!');
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $object): void
    {
        parent::validatePutParamsApi($paramsFields, $object);
        if (
            isset($object->fatherId)
            && !$this->dao->findById($object->fatherId)
        ) {
            Response::Render(HttpStatusCodeEnum::HTTP_NOT_FOUND, 'Categoria pai não encontrada!');
        }
    }
}