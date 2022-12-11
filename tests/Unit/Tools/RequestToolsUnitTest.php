<?php

namespace tests\Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Tools\RequestTools;

class RequestToolsUnitTest extends TestCase
{
    protected function setUp(): void
    {
        $_POST['validPost'] = 'post-valid';
        $_GET['validGet'] = 'get-valid';
        $_SERVER['validServer'] = 'server-valid';
    }

    /**
     * @param $value
     * @param $expected
     * @param $method
     * @return void
     * @dataProvider dataProvideInputRequests
     */
    public function testInputRequest($value, $expected, $method)
    {
        $test = RequestTools::$method($value);
        $this->assertEquals($expected, $test);
    }

    public function dataProvideInputRequests(): array
    {
        return [
            'test $_POST valid' => ['value' => 'validPost', 'expected' => 'post-valid', 'method' => 'inputPost'],
            'test $_POST invalid' => ['value' => 'invalidPost', 'expected' => null, 'method' => 'inputPost'],
            'test $_GET valid' => ['value' => 'validGet', 'expected' => 'get-valid', 'method' => 'inputGet'],
            'test $_GET invalid' => ['value' => 'invalidGet', 'expected' => null, 'method' => 'inputGet'],
            'test $_SERVER valid' => ['value' => 'validServer', 'expected' => 'server-valid', 'method' => 'inputServer'],
            'test $_SERVER invalid' => ['value' => 'invalidServer', 'expected' => null, 'method' => 'inputServer'],
        ];
    }
}