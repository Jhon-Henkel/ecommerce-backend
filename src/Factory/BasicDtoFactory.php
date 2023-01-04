<?php

namespace src\Factory;

use stdClass;

abstract class BasicDtoFactory
{
    public abstract function factory(stdClass $item);
    public abstract function makePublic($item): stdClass;
    public abstract function populateDbToDto(array $item);

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