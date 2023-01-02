<?php

namespace tests\Feature\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\AddressDAO;
use src\Enums\TableEnum;
use tests\Traits\AddressTraits;
use tests\Traits\ClientTraits;

class AddressDaoFeatureTest extends TestCase
{
    use ClientTraits, AddressTraits;

    public AddressDAO $dao;

    protected function setUp(): void
    {
        $this->deleteOnDbAddress1234();
        $this->deleteOnDbClient741();
        $this->insertOnDbClient741();
        $this->insertOnDbAddress1234();
        $this->dao = new AddressDAO(TableEnum::ADDRESS);
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbAddress1234();
        $this->deleteOnDbClient741();
    }

    public function testFindByClientId()
    {
        $address = $this->dao->findByClientId(741);
        $this->assertIsArray($address);
        $this->assertCount(1, $address);
    }

    public function testDeleteByClientId()
    {
        $address = $this->dao->findByClientId(741);
        $this->assertIsArray($address);
        $this->assertCount(1, $address);
        $this->dao->deleteByClientId(741);
        $address = $this->dao->findByClientId(741);
        $this->assertIsArray($address);
        $this->assertCount(0, $address);
    }
}