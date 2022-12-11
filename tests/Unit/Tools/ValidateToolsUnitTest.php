<?php

namespace tests\Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Enums\FieldsEnum;
use src\Exceptions\DatabaseExceptions\QueryTypeException;
use src\Tools\ValidateTools;

class ValidateToolsUnitTest extends TestCase
{
    /**
     * @param array $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateParamsFieldsInArrayDataProvider
     */
    public function testValidateParamsFieldsInArray(array $value, bool $expectedResult)
    {
        $validateParams = array(FieldsEnum::CODE, FieldsEnum::NAME);
        $this->assertEquals($expectedResult, ValidateTools::validateParamsFieldsInArray($validateParams, $value));
    }

    /**
     * @param $type
     * @param $query
     * @return void
     * @dataProvider dataProviderQueryValidator
     */
    public function testQueryTypeValidator($type, $query)
    {
        $this->expectException(QueryTypeException::class);
        $this->expectExceptionMessage('Base de dados não é do tipo ' . $type);
        ValidateTools::validateQueryType($type, $query);
    }

    public function dataProviderQueryValidator(): array
    {
        return [
            'invalidSelect' => ['type' => 'SELECT', 'query' => 'DELETE FROM...'],
            'invalidDelete' => ['type' => 'DELETE', 'query' => 'SELECT *  FROM...'],
            'invalidUpdate' => ['type' => 'UPDATE', 'query' => 'INSERT INTO...'],
            'invalidInsert' => ['type' => 'INSERT', 'query' => 'UPDATE ...']
        ];
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