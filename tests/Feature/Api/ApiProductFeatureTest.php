<?php

namespace tests\Feature\Api;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use src\DAO\CartDAO;
use src\DAO\ProductDAO;
use src\DAO\ProductStockDAO;
use src\Database;
use src\Enums\ApiResponseMessageEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
use src\Exceptions\ProductExceptions\ProductIsLinkedOnCartException;
use stdClass;
use tests\Traits\ClientTraits;
use tests\Traits\HttpRequestTrait;
use tests\Traits\ProductTraits;

class ApiProductFeatureTest extends TestCase
{
    use HttpRequestTrait, ProductTraits, ClientTraits;

    public stdClass $item1;
    public stdClass $item2;
    public ProductDAO $dao;
    public string $api;

    protected function setUp(): void
    {
        $this->deleteCartAndCartItemTest();
        $this->deleteOnDbClient741();
        $this->deleteTestProductsAndStock();
        $this->deleteTestAttributes();
        $this->insertAttributesOnDb();
        $this->item1 = $this->makeStdProduct150();
        $this->item2 = $this->makeStdProduct151();
        $this->dao = new ProductDAO(TableEnum::PRODUCT);
        $this->api = 'api=product';
    }

    protected function tearDown(): void
    {
        $this->deleteCartAndCartItemTest();
        $this->deleteOnDbClient741();
        $this->deleteTestProductsAndStock();
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
        $this->assertEquals("produto-test-150", $data->code);
        $this->assertEquals("Produto Test 150", $data->name);
        $this->assertEquals("product 150 description", $data->description);
        $this->assertEquals(104, $data->categoryId);
        $this->assertIsArray($data->stocks);
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
            'testingNullCategoryId' => ['attribute' => 'categoryId'],
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
            'testingNullCategoryId' => ['attribute' => 'categoryId'],
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function testGetById()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $response = $this->get($this->api . '&id=' . $last['product_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("produto-test-150", $data->code);
        $this->assertEquals("Produto Test 150", $data->name);
        $this->assertEquals("product 150 description", $data->description);
        $this->assertEquals(104, $data->categoryId);
        $this->assertIsArray($data->stocks);
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
        $response = $this->get($this->api);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertCount($beforeInsert + 1, $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $response = $this->delete($this->api . '&id=' . $last['product_id']);
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $response = $this->get($this->api . '&id=' . $last['product_id']);
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
        $this->item1->code = 'produto-test-150-put';
        $this->item1->name = 'Produto Test 150 Put';
        $response = $this->put($this->api . '&id=' . $last['product_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("produto-test-150-put", $data->code);
        $this->assertEquals("Produto Test 150 Put", $data->name);
        $this->assertEquals("product 150 description", $data->description);
        $this->assertEquals(104, $data->categoryId);
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
        $response = $this->put($this->api . '&id=' . $last['product_id'], $this->item1);
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
        $response = $this->put($this->api . '&id=' . $last['product_id'], $this->item1);
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

    /**
     * @param string $attribute
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderMissingAttribute
     */
    public function testMissingAttributePut(string $attribute)
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        unset($this->item1->$attribute);
        $response = $this->put($this->api . '&id=' . $last['product_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
    }

    public function testDeleteProductIsInCartDone()
    {
        $this->post($this->api, $this->item1);
        $stockDAO = new ProductStockDAO(TableEnum::PRODUCT_STOCK);
        $productInserted = $this->dao->findLastInserted();
        $stockInserted = $stockDAO->findLastInserted();
        $this->insertOnDbClient741();
        $db = new Database();
        $db->insert("INSERT INTO cart (cart_client_id, cart_order_done, cart_hash, cart_gift_card_id) VALUES (741, 1, 'ttteeess44', null)");
        $cartDAO = new CartDAO(TableEnum::CART);
        $cartInserted = $cartDAO->findLastInserted();
        $db->insert("INSERT INTO cart_item (cart_item_cart_id, cart_item_stock_id, cart_item_quantity) VALUES (" . $cartInserted['cart_id'] . ", " . $stockInserted['product_stock_id'] . ", 999999999)");
        $response = $this->delete($this->api . '&id=' . $productInserted['product_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(ApiResponseMessageEnum::PRODUCT_IS_LINKED_ON_ORDER, $data);
    }

    public function deleteCartAndCartItemTest()
    {
        $db = new Database();
        $db->delete("DELETE FROM cart_item WHERE cart_item_quantity = 999999999");
        $db->delete("DELETE FROM cart WHERE cart_client_id = 741");
    }

    public function deleteTestProductsAndStock()
    {
        $db = new Database();
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-100'");
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-101'");
        $db->delete("DELETE FROM product_stock WHERE product_stock_code = 'stock-102'");
        $db->delete("DELETE FROM product WHERE product_code = 'produto-test-150'");
        $db->delete("DELETE FROM product WHERE product_code = 'produto-test-151'");
        $db->delete("DELETE FROM product WHERE product_code = 'produto-test-150-put'");
        $db->delete("DELETE FROM product WHERE product_code = 'produto-test-151-put'");
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