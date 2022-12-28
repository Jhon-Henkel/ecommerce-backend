<?php

namespace tests\Unit\Tools;

use Exception;
use PHPUnit\Framework\TestCase;
use src\Tools\DateTools;

class DateToolsUnitTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testStringToDateTimeConverter()
    {
        $date = DateTools::stringToDateTimeConverter('1998-10-12');
        $this->assertInstanceOf(\DateTime::class, $date);
        $this->expectException(Exception::class);
        $date = DateTools::stringToDateTimeConverter(null);
        $this->assertNull($date);
        $date = DateTools::stringToDateTimeConverter('abcd');
        $this->assertNull($date);
    }

    /**
     * @throws Exception
     */
    public function testDateTimeToStringConverter()
    {
        $date = DateTools::stringToDateTimeConverter('1998-10-12');
        $strDate = DateTools::dateTimeToStringConverter($date);
        $this->assertIsString($strDate);
        $this->assertEquals('1998-10-12', $strDate);
        $strDate = DateTools::dateTimeToStringConverter(null);
        $this->assertNull($strDate);
    }
}