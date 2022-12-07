<?php

namespace Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Enums\FieldsEnum;
use src\Tools\ValidateTools;

class ValidateToolsUnitTest extends TestCase
{
    /**
     * @return void
     * @dataProvider validateParamsFieldsInArrayDataProvider
     */
    public function testValidateParamsFieldsInArray(array $value, bool $expectedResult)
    {
        $validateParams = array(FieldsEnum::CODE, FieldsEnum::NAME);
        $this->assertEquals($expectedResult, ValidateTools::validateParamsFieldsInArray($validateParams, $value));
    }

    public function validateParamsFieldsInArrayDataProvider(): array
    {
        return [
            'shouldBeValidWhenReturnIsTrue' => [
                'value' => [FieldsEnum::NAME => 'test', FieldsEnum::CODE => 'test-444'],
                'expectedResult' => true
            ],
            'shouldBeValidWhenReturnIsFalse' => [
                'value' => [FieldsEnum::CODE => '58456'],
                'expectedResult' => false
            ],
            'shouldBeValidWhenReturnIsFalseAndValueIsEmpty' => [
                'value' => [],
                'expectedResult' => false
            ]
        ];
    }
}