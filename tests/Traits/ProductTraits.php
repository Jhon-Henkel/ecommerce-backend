<?php

namespace tests\Traits;

use src\Database;
use src\DTO\ProductDTO;

trait ProductTraits
{
    use ProductStockTrait, BrandTraits, ColorTraits, SizeTraits, CategoryTraits;

    public function makeDtoProductTest145(): ProductDTO
    {
        $size = new ProductDTO();
        $size->setId(145);
        $size->setName('Product Test');
        $size->setCode('product-test-145');
        $size->setUrl('product-test-145/product-test');
        $size->setDescription('Description for product 145');
        $size->setCategoryId(105);
        return $size;
    }

    public function insertOnDbProductTest145(): void
    {
        $stock = 'product_stock_id, product_stock_code, product_stock_name, product_stock_quantity, product_stock_color_id,';
        $stock .= ' product_stock_size_id, product_stock_brand_id, product_stock_product_id, product_stock_price,';
        $stock .= 'product_stock_width, product_stock_height, product_stock_length, product_stock_gross_weight';
        $db = new Database();
        $queries = array(
            "INSERT INTO brand (brand_id, brand_code, brand_name) VALUES (99, 'Brand Test 99', 'brand-test-99')",
            "INSERT INTO color (color_id, color_code, color_name) VALUES (95, 'Color Test 95', 'color-test-95')",
            "INSERT INTO size (size_id, size_code, size_name) VALUES (12, 'Size Test 12', 'size-test-12')",
            "INSERT INTO category (category_id, category_code, category_name, category_father_id) VALUES (105, 'Category Test 105', 'Size-test-105', null)",
            "INSERT INTO product (product_id, product_code, product_name, product_url, product_description, product_category_id) VALUES (145, 'product-test-145', 'Product Test', 'product-test-145/product-test', 'Description for product 145', 105)",
            "INSERT INTO product_stock ($stock) VALUES (74, 'stock-test-74', 'Stock Test', 9999, 95, 12, 99, 145, 10.50, 10, 10, 10, 2)",
            "INSERT INTO product_stock ($stock) VALUES (75, 'stock-test-75', 'Stock Test 75', 9999, 95, 12, 99, 145, 100.59, 15, 20, 10, 5)",
        );
        foreach ($queries as $query) {
            $db->insert($query);
        }
    }

    public function deleteOnDbProductTest145(): void
    {
        $db = new Database();
        $queries = array(
            'DELETE FROM product_stock WHERE product_stock_id = 74',
            'DELETE FROM product_stock WHERE product_stock_id = 75',
            'DELETE FROM product WHERE product_id = 145',
            'DELETE FROM category WHERE category_id = 105',
            'DELETE FROM brand WHERE brand_id = 99',
            'DELETE FROM color WHERE color_id = 95',
            'DELETE FROM size WHERE size_id = 12'
        );
        foreach ($queries as $query) {
            $db->delete($query);
        }
    }
}