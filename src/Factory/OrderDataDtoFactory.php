<?php

namespace src\Factory;

use src\DTO\OrderDataDTO;

class OrderDataDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): OrderDataDTO
    {
        // TODO: Implement factory() method.
    }

    /**
     * @param OrderDataDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        // TODO: Implement makePublic() method.
    }

    public function populateDbToDto(array $item): OrderDataDTO
    {
        // TODO: Implement populateDbToDto() method.
    }
}