<?php

namespace src\Factory;

use src\DTO\AddressDTO;
use stdClass;

class AddressDtoFactory extends BasicDtoFactory
{
    public function factory(stdClass $item): AddressDTO
    {
        $address = new AddressDTO();
        $address->setId($item->id ?? null);
        $address->setClientId($item->clientId);
        $address->setStreet($item->street);
        $address->setZipCode($item->zipCode ?? null);
        $address->setComplement($item->complement ?? null);
        $address->setNumber($item->number ?? null);
        $address->setDistrict($item->district);
        $address->setCity($item->city);
        $address->setState($item->state);
        $address->setReference($item->reference ?? null);
        return $address;
    }

    /**
     * @param AddressDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $address = new stdClass();
        $address->id = $item->getId();
        $address->clientId = $item->getClientId();
        $address->street = $item->getStreet();
        $address->zipCode = $item->getZipCode();
        $address->complement = $item->getComplement();
        $address->number = $item->getNumber();
        $address->district = $item->getDistrict();
        $address->city = $item->getCity();
        $address->state = $item->getState();
        $address->reference = $item->getReference();
        return $address;
    }

    public function populateDbToDto(array $item): AddressDTO
    {
        $address = new AddressDTO();
        $address->setId($item['address_id']);
        $address->setClientId($item['address_client_id']);
        $address->setStreet($item['address_street']);
        $address->setZipCode($item['address_zip_code']);
        $address->setNumber($item['address_number']);
        $address->setComplement($item['address_complement']);
        $address->setDistrict($item['address_district']);
        $address->setCity($item['address_city']);
        $address->setState($item['address_state']);
        $address->setReference($item['address_reference']);
        return $address;
    }
}