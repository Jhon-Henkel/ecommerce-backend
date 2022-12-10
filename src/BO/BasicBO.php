<?php

namespace src\BO;

use src\Api\Response;
use src\Tools\ValidateTools;

class BasicBO
{
    public function validateFields(array $paramsFields, \stdClass $category): void
    {
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$category)) {
            Response::RenderRequiredAttributesMissing();
        }
    }

    public function deleteById(int $id)
    {
        $this->dao->deleteById($id);
    }

    public function findById(int $id)
    {
        $item = $this->dao->findById($id);
        return $item ? $this->populateDbToDto($item) : null;
    }

    public function findAll()
    {
        $item =  $this->dao->findAll();
        if (!$item) {
            return null;
        }
        return $this->factory->makeItensPublic($item);
    }

    public function findLastInserted()
    {
        $search = $this->dao->findLastInserted();
        return $this->populateDbToDto($search);
    }
}