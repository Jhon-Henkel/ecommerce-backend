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
}