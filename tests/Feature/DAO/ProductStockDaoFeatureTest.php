<?php

namespace tests\Feature\DAO;

use PHPUnit\Framework\TestCase;
use src\BO\ProductStockBO;
use src\DAO\ProductStockDAO;
use src\Enums\TableEnum;
use tests\Traits\ProductTraits;

class ProductStockDaoFeatureTest extends TestCase
{
    use ProductTraits;

    public ProductStockDAO $dao;

    protected function setUp(): void
    {
        $this->deleteOnDbProductTest145();
        $this->insertOnDbProductTest145();
        $this->dao = new ProductStockDAO(TableEnum::PRODUCT_STOCK);
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbProductTest145();
    }

    public function testFindByProductId()
    {
        $product = $this->dao->findByProductId(145);
        $this->assertCount(2, $product);
        $this->assertEquals(74, $product[0]['product_stock_id']);
        $product = $this->dao->findByProductId(999999);
        $this->assertCount(0, $product);
    }

    public function testDeleteByProductId()
    {
        $product = $this->dao->findByProductId(145);
        $this->assertCount(2, $product);
        $this->dao->deleteAllByProductId(145);
        $product = $this->dao->findByProductId(145);
        $this->assertCount(0, $product);
    }
}