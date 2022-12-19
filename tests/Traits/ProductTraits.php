<?php

namespace tests\Traits;

use src\DTO\ProductDTO;

trait ProductTraits
{
    public function makeDtoProductTest145(): ProductDTO
    {
        $size = new ProductDTO();
        $size->setId(145);
        $size->setName('Product Test');
        $size->setCode('product-test-145');
        $size->setUrl('product-test-145/product-test');
        $size->setDescription('Description for product 145');
        $size->setCategoryId(50);
        return $size;
    }
}