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

    public function makeStdAddressTest1234(): \stdClass
    {
        $address = new \stdClass();
        $address->id = 1234;
        $address->clientId = 899;
        $address->number = 88;
        $address->reference = 'Reference';
        $address->state = 'State';
        $address->city = 'City';
        $address->district = 'District';
        $address->complement = 'Complement';
        $address->zipCode = '88780-000';
        $address->street = 'Street';
        $address->createdAt = new \DateTime('2022-10-01');
        $address->updatedAt = new \DateTime('2022-11-10');
        return $address;
    }

    public function makeDbAddressTest1234(): array
    {
        return array(
            'address_id' => 1234,
            'address_client_id' => 899,
            'address_number' => 88,
            'address_reference' => 'Reference',
            'address_state' => 'State',
            'address_city' => 'City',
            'address_district' => 'District',
            'address_complement' => 'Complement',
            'address_zip_code' => '88780-000',
            'address_street' => 'Street',
            'address_created_at' => new \DateTime('2022-10-01'),
            'address_updated_at' => new \DateTime('2022-11-10')
        );
    }
}