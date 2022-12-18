<?php

namespace src\DAO;

use src\DTO\ClientDTO;
use src\Tools\DateTools;

class ClientDAO extends BasicDAO
{
    public function getColumnsToInsert(): string
    {
        $columns = "client_name, client_document_type, client_document, client_main_phone,";
        $columns .= " client_second_phone, client_email, client_birth_date, client_password";
        return $columns;
    }

    public function getParamsStringToInsert(): string
    {
        return ":name, :documentType, :document, :mainPhone, :secondPhone, :email, :birthDate, :password";
    }

    /**
     * @param ClientDTO $item
     * @return array
     */
    public function getParamsArrayToInsert($item): array
    {
        return array(
            'name' => $item->getName(),
            'documentType' => $item->getDocumentType(),
            'document' => $item->getDocument(),
            'mainPhone' => $item->getMainPhone(),
            'secondPhone' => $item->getSecondPhone(),
            'email' => $item->getEmail(),
            'birthDate' => DateTools::dateTimeToStringConverter($item->getBirthDate()),
            'password' => $item->getPassword()
        );
    }

    public function getUpdateSting(): string
    {
        $updateString = "client_name = :name, client_document_type = :documentType, client_document = :document,";
        $updateString .= " client_main_phone = :mainPhone, client_second_phone = :secondPhone,";
        $updateString .= " client_email = :email, client_birth_date = :birthDate, client_password = :password";
        return $updateString;
    }

    public function getWhereClausuleToUpdate(): string
    {
        return 'client_id = :id';
    }

    public function getParamsArrayToUpdate($item): array
    {
        return array_merge($this->getParamsArrayToInsert($item), array('id' => $item->getId()));
    }
}