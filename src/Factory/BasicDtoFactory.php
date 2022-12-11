<?php

namespace src\Factory;

abstract class BasicDtoFactory
{
    abstract function factory(\stdClass $item);
    abstract function makePublic($item): \stdClass;
    abstract function populateDbToDto(array $item);

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