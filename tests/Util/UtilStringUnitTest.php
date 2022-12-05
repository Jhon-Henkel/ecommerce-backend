<?php

namespace Util;

use PHPUnit\Framework\TestCase;
use src\Util\UtilString;

class UtilStringUnitTest extends TestCase
{
    /**
     * @param string $value
     * @param string $expectedResult
     * @return void
     * @dataProvider dataProviderOnlyNumbersTest
     */
    public function testOnlyNumbers(string $value, string $expectedResult): void
    {
        $onlyNumberFilter = new UtilString();
        $returnValue = $onlyNumberFilter->onlyNumbers($value);
        $this->assertEquals($expectedResult, $returnValue);
    }

    public function dataProviderOnlyNumbersTest(): array
    {
        return [
            'shouldBeValidWhenReturnIsOnlyNumbersFirstTest' => ['value' => 't35tC4s3', 'expectedResult' => '3543'],
            'shouldBeValidWhenReturnIsOnlyNumbersSecondTest' => ['value' => '123.456.789-10', 'expectedResult' => '12345678910'],
            'shouldBeValidWhenReturnIsOnlyNumbersThirdTest' => ['value' => '00T3stCas3', 'expectedResult' => '0033'],
            'shouldBeValidWhenReturnIsEmpty' => ['value' => 'abcdefgh', 'expectedResult' => ''],
        ];
    }
}