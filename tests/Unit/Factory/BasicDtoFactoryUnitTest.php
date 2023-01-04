<?php

namespace tests\Unit\Factory;

use DateTime;
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
        $this->itemToTest = $this->makeTestItens();
        $this->basicDtoFactory = new class extends BasicDtoFactory {

            public BrandDtoFactory $brandDtoFactory;

            public function __construct()
            {
                $this->brandDtoFactory = new BrandDtoFactory();
            }

            public function factory(\stdClass $item): BrandDTO
            {
                return $this->brandDtoFactory->factory($item);
            }
            public function makePublic($item): \stdClass
            {
                return $this->brandDtoFactory->makePublic($item);
            }
            public function populateDbToDto(array $item): BrandDTO
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

    public function makeTestItens(): array
    {
        $brand12 = array();
        $brand12['brand_id'] = 12;
        $brand12['brand_name'] = 'Brand 12';
        $brand12['brand_code'] = 'brand-12';
        $brand12['brand_created_at'] = '2022-10-10';
        $brand12['brand_updated_at'] = '2022-11-11';
        $brand13 = array();
        $brand13['brand_id'] = 13;
        $brand13['brand_name'] = 'Brand 13';
        $brand13['brand_code'] = 'brand-13';
        $brand13['brand_created_at'] = '2022-10-10';
        $brand13['brand_updated_at'] = '2022-11-11';
        return [$brand12, $brand13];
    }
}