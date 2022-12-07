<?php

namespace Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Tools\RequestTools;

class RequestToolsUnitTest extends TestCase
{
    public function testInputGet()
    {
        $_GET['test-get'] = 'test-get-return';
        $this->assertEquals('test-get-return', RequestTools::inputGet('test-get'));
    }

    public function testInputPost()
    {
        $_POST['test-post'] = 'test-post-return';
        $this->assertEquals('test-post-return', RequestTools::inputPost('test-post'));
    }

    public function testInputPhpInput()
    {
        // todo desenvolver teste
        self::markTestSkipped('Desenvolver');
    }
}