<?php

namespace tests\Traits;

use src\DTO\AddressDTO;

trait AddressTraits
{
    public function makeDtoAddressTest1234(): AddressDTO
    {
        $address = new AddressDTO();
        $address->setId(1234);
        $address->setClientId(899);
        $address->setNumber(88);
        $address->setReference('Reference');
        $address->setState('State');
        $address->setCity('City');
        $address->setDistrict('District');
        $address->setComplement('Complement');
        $address->setZipCode('88780-000');
        $address->setStreet('Street');
        $address->setCreatedAt(new \DateTime('2022-10-01'));
        $address->setUpdatedAt(new \DateTime('2022-11-10'));
        return $address;
    }
}