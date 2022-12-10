<?php

namespace src\Factory;

abstract class BasicDtoFactory
{
    public function makeItensPublic(array $itens): array
    {
        $itensFactored = array();
        foreach ($itens as $item) {
            $itemDto = $this->populateDbToDto($item);
            $itensFactored[] = $this->makePublic($itemDto);
        }
        return $itensFactored;
    }
}