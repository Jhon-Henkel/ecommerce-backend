<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\BrandDTO;
use src\Factory\BasicDtoFactory;
use src\Factory\BrandDtoFactory;

class BasicDtoFactoryUnitTest extends TestCase
{
    public $basicDtoFactory;
    public array $itemToTest;

    protected function setUp(): void
    {
        $this->itemToTest = $this->makeTestItem();
        $this->basicDtoFactory = new class extends BasicDtoFactory {

            public BrandDtoFactory $brandDtoFactory;

            function __construct()
            {
                $this->brandDtoFactory = new BrandDtoFactory();
            }

            function factory(\stdClass $item): BrandDTO
            {
                return $this->brandDtoFactory->factory($item);
            }
            function makePublic($item): \stdClass
            {
                return $this->brandDtoFactory->makePublic($item);
            }
            function populateDbToDto(array $item): BrandDTO
            {
                return $this->brandDtoFactory->populateDbToDto($item);
            }
        };
    }

    /**
     * @return void
     * @dataProvider
     */
    public function testMakeItensPublic()
    {
        $itemTest = $this->basicDtoFactory->makeItensPublic($this->itemToTest);
        $this->assertIsArray($itemTest);
        $this->assertInstanceOf(\stdClass::class, $itemTest[0]);
        $this->assertInstanceOf(\stdClass::class, $itemTest[1]);
        $this->assertEquals(12, $itemTest[0]->id);
        $this->assertEquals('Brand 12', $itemTest[0]->name);
        $this->assertEquals('brand-12', $itemTest[0]->code);
        $this->assertEquals(13, $itemTest[1]->id);
        $this->assertEquals('Brand 13', $itemTest[1]->name);
        $this->assertEquals('brand-13', $itemTest[1]->code);
    }

    public function makeTestItem(): array
    {
        $brand12 = array();
        $brand12['brand_id'] = 12;
        $brand12['brand_name'] = 'Brand 12';
        $brand12['brand_code'] = 'brand-12';
        $brand13 = array();
        $brand13['brand_id'] = 13;
        $brand13['brand_name'] = 'Brand 13';
        $brand13['brand_code'] = 'brand-13';
        return [$brand12, $brand13];
    }
}