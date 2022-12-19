<?php

namespace src\DAO;

use src\DTO\AddressDTO;

class AddressDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        $columns = 'address_client_id, address_street, address_zip_code, address_number,';
        $columns .= ' address_complement, address_district, address_city, address_state, address_reference';
        return $columns;
    }

    public function getParamsStringToInsert(): string
    {
        return ':clientId, :street, :zip, :number, :complement, :district, :city, :state, :reference';
    }

    /**
     * @param AddressDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'clientId' => $item->getClientId(),
            'street' => $item->getStreet(),
            'zip' => $item->getZipCode(),
            'number' => $item->getNumber(),
            'complement' => $item->getComplement(),
            'district' => $item->getDistrict(),
            'city' => $item->getCity(),
            'state' => $item->getState(),
            'reference' => $item->getReference()
        );
    }

    public function getUpdateSting(): string
    {
        $strUpdate = 'address_client_id = :clientId, address_street = :street, address_zip_code = :zip,';
        $strUpdate .= ' address_number = :number, address_complement = :complement, address_district = :district,';
        $strUpdate .= ' address_city = :city, address_state = :state, address_reference = :reference';
        return $strUpdate;
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'address_id = :id';
    }

    /**
     * @param AddressDTO $item
     * @return array
     */
    public function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }

    public function findByClientId(int $id): null|array
    {
        $query = 'SELECT * FROM address WHERE address_client_id = :id';
        return $this->database->select($query, array('id' => $id));
    }

    public function deleteByClientId(int $id): void
    {
        $query = "DELETE FROM address WHERE address_client_id = :id";
        $this->database->delete($query, array('id' => $id));
    }
}