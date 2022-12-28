<?php

namespace src\Enums;

class OrderEnum
{
    const ORDER_NOT_DONE = 0;
    const ORDER_DONE = 1;
    const STATUS_PENDENTE = 5;
    const STATUS_PAGO = 6;
    const STATUS_FATURADO = 7;
    const STATUS_ENVIADO = 8;
    const STATUS_ENTREGUE = 9;
    const STATUS_CANCELADO = 10;

    public static function getListOfAllStatus(): array
    {
        return array(
            self::STATUS_PENDENTE,
            self::STATUS_PAGO,
            self::STATUS_FATURADO,
            self::STATUS_ENVIADO,
            self::STATUS_ENTREGUE,
            self::STATUS_CANCELADO
        );
    }
}