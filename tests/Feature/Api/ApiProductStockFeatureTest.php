<?php

namespace tests\Feature\Api;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use src\DAO\ProductDAO;
use src\DAO\ProductStockDAO;
use src\Database;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
use stdClass;
use tests\Traits\HttpRequestTrait;
use tests\Traits\ProductStockTrait;
use tests\Traits\ProductTraits;

class ApiProductStockFeatureTest extends TestCase
{
    use ProductStockTrait, HttpRequestTrait, ProductTraits;

    public stdClass $item1;
    public stdClass $item2;
    public ProductStockDAO $dao;
    public string $api;

    /**
     * @throws GuzzleException
     */
    protected function setUp(): void
    {
        $this->deleteStocksTest();
        $this->deleteProductTest();
        $this->deleteTestAttributes();
        $this->insertAttributesOnDb();
        $productId = $this->insertProductTest();
        $this->item1 = $this->makeStdStock100();
        $this->item1->productId = $productId;
        $this->item2 = $this->makeStdStock101();
        $this->item2->productId = $productId;
        $this->dao = new ProductStockDAO(TableEnum::PRODUCT_STOCK);
        $this->api = 'api=stock';
    }

    protected function tearDown(): void
    {
        $this->deleteStocksTest();
        $this->deleteProductTest();
        $this->deleteTestAttributes();
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPost()
    {
        $response = $this->post($this->api, $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals("stock-100", $data->code);
        $this->assertEquals("Stock Teste 100", $data->name);
        $this->assertEquals(15, $data->quantity);
        $this->assertEquals(94, $data->colorId);
        $this->assertEquals(11, $data->sizeId);
        $this->assertEquals(98, $data->brandId);
        $this->assertEquals(2, $data->price);
        $this->assertEquals(18, $data->width);
        $this->assertEquals(159, $data->height);
        $this->assertEquals(36, $data->length);
        $this->assertEquals(1600, $data->grossWeight);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPostParametersInvalid(string $attribute)
    {
        $this->item1->$attribute = null;
        $response = $this->post($this->api, $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('O valor para o seguinte campo é inválido: ' . $attribute, $data);
    }

    public function dataProviderParametersInvalid(): array
    {
        return [
            'testingNullCode' => ['attribute' => 'code'],
            'testingNullName' => ['attribute' => 'name'],
            'testingNullQuantity' => ['attribute' => 'quantity'],
            'testingNullColorId' => ['attribute' => 'colorId'],
            'testingNullSizeId' => ['attribute' => 'sizeId'],
            'testingNullBrandId' => ['attribute' => 'brandId'],
            'testingNullProductId' => ['attribute' => 'productId'],
            'testingNullPrice' => ['attribute' => 'price'],
            'testingNullWidth' => ['attribute' => 'width'],
            'testingNullHeight' => ['attribute' => 'height'],
            'testingNullLength' => ['attribute' => 'length'],
            'testingNullGrossWeight' => ['attribute' => 'grossWeight']
        ];
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderHasExistAttributeTest
     */
    public function testDoublePost(string $attribute)
    {
        $this->item2->$attribute = $this->item1->$attribute;
        $this->post($this->api, $this->item1);
        $response = $this->post($this->api, $this->item2);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CONFLICT, $response->getStatusCode());
        $this->assertEquals('O seguinte atributo já está cadastrado: ' . $attribute, $data);
    }

    /**
     * @param string $attribute
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderMissingAttribute
     */
    public function testMissingAttributePost(string $attribute)
    {
        unset($this->item1->$attribute);
        $response = $this->post($this->api, $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
    }

    public function dataProviderMissingAttribute(): array
    {
        return [
            'testingMissingCode' => ['attribute' => 'code'],
            'testingMissingName' => ['attribute' => 'name'],
            'testingMissingQuantity' => ['attribute' => 'quantity'],
            'testingMissingColorId' => ['attribute' => 'colorId'],
            'testingMissingSizeId' => ['attribute' => 'sizeId'],
            'testingMissingBrandId' => ['attribute' => 'brandId'],
            'testingMissingPrice' => ['attribute' => 'price'],
            'testingMissingWidth' => ['attribute' => 'width'],
            'testingMissingHeight' => ['attribute' => 'height'],
            'testingMissingLength' => ['attribute' => 'length'],
            'testingMissingGrossWeight' => ['attribute' => 'grossWeight']
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function testGetById()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $response = $this->get($this->api . '&id=' . $last['product_stock_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("stock-100", $data->code);
        $this->assertEquals("Stock Teste 100", $data->name);
        $this->assertEquals(15, $data->quantity);
        $this->assertEquals(94, $data->colorId);
        $this->assertEquals(11, $data->sizeId);
        $this->assertEquals(98, $data->brandId);
        $this->assertEquals(2, $data->price);
        $this->assertEquals(18, $data->width);
        $this->assertEquals(159, $data->height);
        $this->assertEquals(36, $data->length);
        $this->assertEquals(1600, $data->grossWeight);
    }

    public function testGetByInvalidId()
    {
        $response = $this->get($this->api . '&id=' . uniqid());
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('Registro não encontrado!', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testIndex()
    {
        $response = $this->get($this->api);
        $beforeInsert = count(json_decode($response->getBody()));
        $this->post($this->api, $this->item2);
        $this->post($this->api, $this->item1);
        $response = $this->get($this->api);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertCount($beforeInsert + 2, $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $response = $this->delete($this->api . '&id=' . $last['product_stock_id']);
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $response = $this->get($this->api . '&id=' . $last['product_stock_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('Registro não encontrado!', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPut()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $this->item1->code = 'stock-100-put';
        $this->item1->name = 'Stock Teste 100 Put';
        $response = $this->put($this->api . '&id=' . $last['product_stock_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("stock-100-put", $data->code);
        $this->assertEquals("Stock Teste 100 Put", $data->name);
        $this->assertEquals(15, $data->quantity);
        $this->assertEquals(94, $data->colorId);
        $this->assertEquals(11, $data->sizeId);
        $this->assertEquals(98, $data->brandId);
        $this->assertEquals(2, $data->price);
        $this->assertEquals(18, $data->width);
        $this->assertEquals(159, $data->height);
        $this->assertEquals(36, $data->length);
        $this->assertEquals(1600, $data->grossWeight);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPutParametersInvalid(string $attribute)
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $this->item1->$attribute = null;
        $response = $this->put($this->api . '&id=' . $last['product_stock_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('O valor para o seguinte campo é inválido: ' . $attribute, $data);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderHasExistAttributeTest
     */
    public function testPutHasExistAttribute(string $attribute)
    {
        $this->post($this->api, $this->item2);
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $this->item1->$attribute = $this->item2->$attribute;
        $response = $this->put($this->api . '&id=' . $last['product_stock_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CONFLICT, $response->getStatusCode());
        $this->assertEquals('O seguinte atributo já está cadastrado: ' . $attribute, $data);
    }

    public function dataProviderHasExistAttributeTest(): array
    {
        return [
            'testingExistingCode' => ['attribute' => 'code'],
            'testingExistingName' => ['attribute' => 'name']
        ];
    }

//    /**
//     * @param string $attribute
//     * @return void
//     * @throws GuzzleException
//     * @dataProvider dataProviderMissingAttribute
//     */
//    public function testMissingAttributePut(string $attribute)
//    {
//        $this->post($this->api, $this->item1);
//        $last = $this->dao->findLastInserted();
//        unset($this->item1->$attribute);
//        $response = $this->put($this->api . '&id=' . $last['product_id'], $this->item1);
//        $data = json_decode($response->getBody());
//        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
//        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
//    }
//
//    public function testDeleteProductIsInCartDone()
//    {
//        $this->post($this->api, $this->item1);
//        $stockDAO = new ProductStockDAO(TableEnum::PRODUCT_STOCK);
//        $productInserted = $this->dao->findLastInserted();
//        $stockInserted = $stockDAO->findLastInserted();
//        $this->insertOnDbClient741();
//        $db = new Database();
//        $db->insert("INSERT INTO cart (cart_client_id, cart_order_done, cart_hash, cart_gift_card_id) VALUES (741, 1, 'ttteeess44', null)");
//        $cartDAO = new CartDAO(TableEnum::CART);
//        $cartInserted = $cartDAO->findLastInserted();
//        $db->insert("INSERT INTO cart_item (cart_item_cart_id, cart_item_stock_id, cart_item_quantity) VALUES (" . $cartInserted['cart_id'] . ", " . $stockInserted['product_stock_id'] . ", 999999999)");
//        $response = $this->delete($this->api . '&id=' . $productInserted['product_id']);
//        $data = json_decode($response->getBody());
//        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
//        $this->assertEquals(ApiResponseMessageEnum::PRODUCT_IS_LINKED_ON_ORDER, $data);
//    }


    /**
     * @throws GuzzleException
     */
    public function insertProductTest(): int
    {
        $this->post('api=product', $this->makeStdProduct151());
        $productDAO = new ProductDAO(TableEnum::PRODUCT);
        $last = $productDAO->findLastInserted();
        return $last['product_id'];
    }

    public function deleteProductTest()
    {
        $db = new Database();
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-102'");
        $db->delete("DELETE FROM product WHERE product_code = 'produto-test-151'");
    }

    public function deleteStocksTest()
    {
        $db = new Database();
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-100'");
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-101'");
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-100-put'");
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-101-put'");
    }

    public function deleteTestAttributes()
    {
        $db = new Database();
        $queries = array(
            "DELETE FROM brand WHERE brand_id = 99",
            "DELETE FROM brand WHERE brand_id = 98",
            "DELETE FROM color WHERE color_id = 95",
            "DELETE FROM color WHERE color_id = 94",
            "DELETE FROM size WHERE size_id = 12",
            "DELETE FROM size WHERE size_id = 11",
            "DELETE FROM category WHERE category_id = 105",
            "DELETE FROM category WHERE category_id = 104"
        );
        foreach ($queries as $query) {
            $db->delete($query);
        }
    }

    public function insertAttributesOnDb()
    {
        $db = new Database();
        $queries = array(
            "INSERT INTO brand (brand_id, brand_code, brand_name) VALUES (99, 'Brand Test 99', 'brand-test-99')",
            "INSERT INTO brand (brand_id, brand_code, brand_name) VALUES (98, 'Brand Test 98', 'brand-test-989')",
            "INSERT INTO color (color_id, color_code, color_name) VALUES (95, 'Color Test 95', 'color-test-95')",
            "INSERT INTO color (color_id, color_code, color_name) VALUES (94, 'Color Test 94', 'color-test-94')",
            "INSERT INTO size (size_id, size_code, size_name) VALUES (12, 'Size Test 12', 'size-test-12')",
            "INSERT INTO size (size_id, size_code, size_name) VALUES (11, 'Size Test 11', 'size-test-11')",
            "INSERT INTO category (category_id, category_code, category_name, category_father_id) VALUES (105, 'Category Test 105', 'category-test-105', null)",
            "INSERT INTO category (category_id, category_code, category_name, category_father_id) VALUES (104, 'Category Test 104', 'category-test-104', null)"
        );
        foreach ($queries as $query) {
            $db->insert($query);
        }
    }
}