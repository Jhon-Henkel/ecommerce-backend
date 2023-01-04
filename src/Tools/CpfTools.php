<?php

namespace src\Tools;

class CpfTools
{
    public static function validate(string $cpf): bool
    {
        $cpf = StringTools::onlyNumbers($cpf);
        if (strlen($cpf) != 11) return false;
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}