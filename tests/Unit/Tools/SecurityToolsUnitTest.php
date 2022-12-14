<?php

namespace tests\Unit\Tools;

use PHPUnit\Framework\TestCase;
use src\Tools\SecurityTools;

class SecurityToolsUnitTest extends TestCase
{
    public string $stringDecrypted = '12345678';

    public function testGenerateMd5UniqId()
    {
        $hashMd5 = SecurityTools::generateMd5UniqId();
        $this->assertIsString($hashMd5);
    }

    public function testStringEncryptAndDecryptAes()
    {
        $stringEncrypted = SecurityTools::strEncryptAes($this->stringDecrypted);
        $this->assertIsString($stringEncrypted);
        $stringDecrypted = SecurityTools::strDecryptAes($stringEncrypted);
        $this->assertEquals($this->stringDecrypted, $stringDecrypted);
    }

    public function testGenerateAndValidatePassword()
    {
        $stringEncrypted = SecurityTools::generateHashPassword($this->stringDecrypted);
        $this->assertTrue(SecurityTools::validatePassword($this->stringDecrypted, $stringEncrypted));
    }
}