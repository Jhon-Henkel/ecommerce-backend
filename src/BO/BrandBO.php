<?php

namespace src\BO;

use src\Api\Response;
use src\Tools\ValidateTools;
use stdClass;

class BrandBO
{
    /**
     * @param array $paramsFields
     * @param stdClass $brand
     * @return void
     * todo melhorar esse validate
     */
    public function validatePostParamsApi(array $paramsFields, stdClass $brand)
    {
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$brand)) {
            Response::RenderRequiredAtributesMissing();
        }
    }
}