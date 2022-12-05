<?php

namespace Util\CpfValidator;

use PHPUnit\Framework\TestCase;
use src\Util\CpfValidator\CpfValidator;

class CpfValidatorUnitTest extends TestCase
{
    /**
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider dataProviderTestValidator
     */
    public function testValidator(string $value, bool $expectedResult): void
    {
        $this->assertEquals($expectedResult, CpfValidator::validate($value));
    }

    public function dataProviderTestValidator(): array
    {
        return [
            'shouldBeValidWhenReturnTrueFirstTest' => ['value' => '244.541.660-48', 'expectedResult' => true],
            'shouldBeValidWhenReturnTrueSecondTest' => ['value' => '08486367085', 'expectedResult' => true],
            'shouldBeValidWhenReturnFalseFirstTest' => ['value' => '111.222.333-44', 'expectedResult' => false],
            'shouldBeValidWhenReturnFalseSecondTest' => ['value' => 'cpfInvalido', 'expectedResult' => false]
        ];
    }
}