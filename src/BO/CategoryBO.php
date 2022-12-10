<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CategoryDAO;
use src\DTO\CategoryDTO;
use src\Enums\FieldsEnum;
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

    public function validatePutParamsApi(array $paramsFields, \stdClass $category): void
    {
        $this->validateFields($paramsFields, $category);
        if (!$this->dao->findById($category->id)) {
            Response::RenderNotFound();
        }
        if ($this->dao->findByCodeExceptId($category->code, $category->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByNameExceptId($category->name, $category->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
        if (
            isset($category->fatherId)
            && !$this->dao->findById($category->fatherId)
        ) {
            Response::Render(HttpStatusCodeEnum::HTTP_NOT_FOUND, 'Categoria pai não encontrada!');
        }
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