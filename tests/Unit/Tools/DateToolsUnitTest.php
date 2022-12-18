<?php

namespace tests\Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Tools\DateTools;

class DateToolsUnitTest extends TestCase
{
    public function testStringToDateTimeConverter()
    {
        $date = DateTools::stringToDateTimeConverter('1998-10-12');
        $this->assertInstanceOf(\DateTime::class, $date);
        $this->expectException(\Exception::class);
        DateTools::stringToDateTimeConverter('abcd');
    }

    public function testDateTimeToStringConverter()
    {
        $date = DateTools::stringToDateTimeConverter('1998-10-12');
        $strDate = DateTools::dateTimeToStringConverter($date);
        $this->assertIsString($strDate);
        $this->assertEquals('1998-10-12', $strDate);
    }
}