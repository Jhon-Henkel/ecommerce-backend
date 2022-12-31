<?php

namespace tests\Traits;

trait ShippingCorreiosCalculateTraits
{
    public function makeCalculatedResponseCorreiosMock()
    {
        return json_decode('{
            "Codigo": "41106",
            "Valor": "105,70",
            "PrazoEntrega": "6",
            "ValorSemAdicionais": "105,70",
            "ValorMaoPropria": "0,00",
            "ValorAvisoRecebimento": "0,00",
            "ValorValorDeclarado": "0,00",
            "EntregaDomiciliar": "S",
            "EntregaSabado": "N",
            "obsFim": {},
            "Erro": "011",
            "MsgErro": {}
        }');
    }
}