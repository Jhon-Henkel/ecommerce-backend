<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CategoryDAO;
use src\DTO\CategoryDTO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;

class CategoryBO extends BasicBO
{
    public CategoryDAO $dao;

    public function __construct()
    {
        $this->dao = new CategoryDAO('category');
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $category): void
    {
        $this->validateFields($paramsFields, $category);
        if ($this->dao->findByCode($category->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByName($category->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
        if (
            isset($category->fatherId)
            && !$this->dao->findById($category->fatherId)
        ) {
            Response::Render(HttpStatusCodeEnum::HTTP_NOT_FOUND, 'Categoria pai não encontrada!');
        }
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

    public function findLastInserted(): CategoryDTO
    {
        $search = $this->dao->findLastInserted();
        return $this->populateDbToDto($search);
    }

    public function populateDbToDto(array $category): CategoryDTO
    {
        $categoryDTO = new CategoryDTO();
        $categoryDTO->setId($category['category_id']);
        $categoryDTO->setName($category['category_name']);
        $categoryDTO->setCode($category['category_code']);
        $categoryDTO->setFatherId($category['category_father_id']);
        return $categoryDTO;
    }
}