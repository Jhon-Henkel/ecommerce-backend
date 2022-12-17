<?php

namespace src\BO;

use src\DAO\AddressDAO;
use src\Enums\TableEnum;
use src\Factory\AddressDtoFactory;

class AddressBO extends BasicBO
{
    public AddressDAO $dao;
    public AddressDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new AddressDAO(TableEnum::ADDRESS);
        $this->factory = new AddressDtoFactory();
    }

    public function findByClientId(int $id): null|array
    {
        $addresses = $this->dao->findByClientId($id);
        $addressesFind = array();
        foreach ($addresses as $address) {
            $addressesFind[] = $this->factory->populateDbToDto($address);
        }
        return $addressesFind;
    }

    public function deleteAddressesByClientId(int $id): void
    {
        $this->dao->deleteByClientId($id);
    }
}