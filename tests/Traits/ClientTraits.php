<?php

namespace tests\Traits;

use src\Database;
use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;
use stdClass;

trait ClientTraits
{
    public function makeDtoClientTest741(): ClientDTO
    {
        $client = new ClientDTO();
        $client->setId(741);
        $client->setPassword('12345678');
        $client->setBirthDate(new \DateTime('1995-12-10'));
        $client->setEmail('test@testmail.com');
        $client->setSecondPhone('(48)98475-5588');
        $client->setMainPhone('(48)99655-4577');
        $client->setDocument('985.785.258-88');
        $client->setDocumentType(DocumentEnum::CPF);
        $client->setName('Fulaninho da Silva');
        $client->setCreatedAt(new \DateTime('2022-10-01'));
        $client->setUpdatedAt(new \DateTime('2022-11-10'));
        return $client;
    }

    public function makeStdClientTest741(): stdClass
    {
        $client = new stdClass();
        $client->id = 741;
        $client->password = '12345678';
        $client->birthDate = '1995-12-10';
        $client->email = 'test@testmail.com';
        $client->secondPhone = '(48)98475-5588';
        $client->mainPhone = '(48)99655-4577';
        $client->document = '985.785.258-88';
        $client->documentType = DocumentEnum::CPF;
        $client->name = 'Fulaninho da Silva';
        return $client;
    }

    public function makeDbClientTest741(): array
    {
        $client = array();
        $client['client_id'] = 741;
        $client['client_password'] = '12345678';
        $client['client_birth_date'] = '1995-12-10';
        $client['client_email'] = 'test@testmail.com';
        $client['client_second_phone'] = '(48)98475-5588';
        $client['client_main_phone'] = '(48)99655-4577';
        $client['client_document'] = '985.785.258-88';
        $client['client_document_type'] = DocumentEnum::CPF;
        $client['client_name'] = 'Fulaninho da Silva';
        return $client;
    }

    public function insertOnDbClient741()
    {
        $client = "client_id, client_name, client_document_type, client_document, client_main_phone,";
        $client .= " client_second_phone, client_email, client_birth_date, client_password";
        $query = "INSERT INTO client ($client) VALUES (741, 'Fulaninho da Silva', 2, '985.785.258-88', '(48)98475-5588', '(48)99655-4577', 'test@testmail.com', '1995-12-10', '12345678')";
        $db = new Database();
        $db->insert($query);
    }

    public function deleteOnDbClient741()
    {
        $db = new Database();
        $db->delete("DELETE FROM client WHERE client_id = 741");
    }
}