<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\ColorDAO;
use src\DTO\ColorDTO;
use src\Enums\FieldsEnum;
use src\Factory\ColorDtoFactory;

class ColorBO extends BasicBO
{
    public ColorDAO $dao;
    public ColorDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ColorDAO('color');
        $this->factory = new ColorDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $color): void
    {
        $this->validateFields($paramsFields, $color);
        if ($this->dao->findByCode($color->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByName($color->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $color): void
    {
        $this->validateFields($paramsFields, $color);
        if (!$this->dao->findById($color->id)) {
            Response::RenderNotFound();
        }
        if ($this->dao->findByCodeExceptId($color->code, $color->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByNameExceptId($color->name, $color->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function insert(ColorDTO $color): void
    {
        $columns = 'color_code, color_name';
        $values = ':code, :name';
        $params = array(
            'code' => $color->getCode(),
            'name' => $color->getName(),
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(ColorDTO $color)
    {
        $values = 'color_code = :code, color_name = :name';
        $where = 'color_id = :id';
        $params = array(
            'id' => $color->getId(),
            'code' => $color->getCode(),
            'name' => $color->getName(),
        );
        $this->dao->update($values, $where, $params);
    }

    public function populateDbToDto(array $color): ColorDTO
    {
        $colorDTO = new ColorDTO();
        $colorDTO->setId($color['color_id']);
        $colorDTO->setName($color['color_name']);
        $colorDTO->setCode($color['color_code']);
        return $colorDTO;
    }
}