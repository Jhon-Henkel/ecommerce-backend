<?php

namespace src\Tools;

use src\Configs\EncryptConfigs;

class SecurityTools
{
    public static function generateHashPassword(string $password): string
    {
        return trim(password_hash($password, PASSWORD_BCRYPT));
    }

    public static function validatePassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function strEncryptAes(string $str): string
    {
        $aesIv = EncryptConfigs::AES_IV;
        $aesKey = EncryptConfigs::AES_KEY;
        $cipher = EncryptConfigs::CIPHER_ALGORITHM;
        return bin2hex(openssl_encrypt($str, $cipher, $aesKey, OPENSSL_RAW_DATA, $aesIv));
    }

    public static function strDecryptAes(string $str): string
    {
        $aesIv = EncryptConfigs::AES_IV;
        $aesKey = EncryptConfigs::AES_KEY;
        $cipher = EncryptConfigs::CIPHER_ALGORITHM;
        return openssl_decrypt(hex2bin($str), $cipher, $aesKey, OPENSSL_RAW_DATA, $aesIv);
    }

    public static function generateMd5UniqId(): string
    {
        return md5(uniqid());
    }
}