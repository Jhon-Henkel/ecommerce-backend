<?php

namespace tests\Feature\Api;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use src\DAO\CategoryDAO;
use src\Database;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
use stdClass;
use tests\Traits\CategoryTraits;
use tests\Traits\HttpRequestTrait;
use tests\Traits\ProductTraits;

class ApiCategoryFeatureTest extends TestCase
{
    use CategoryTraits, HttpRequestTrait, ProductTraits;

    public stdClass $item1;
    public stdClass $item2;
    public CategoryDAO $dao;
    public string $api;

    protected function setUp(): void
    {
        $this->api = 'api=category';
        $this->deleteBrands();
        $this->deleteOnDbProductTest145();
        $this->item1 = $this->makeStdCategoryTest105();
        $this->item2 = $this->makeStdCategoryTest106();
        $this->dao = new CategoryDAO(TableEnum::CATEGORY);
    }

    protected function tearDown(): void
    {
        $this->deleteOnDbProductTest145();
        $this->deleteBrands();
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPost()
    {
        $response = $this->post($this->api, $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('category-test-105', $data->code);
        $this->assertEquals('Category Test 105', $data->name);
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
            'testingNullFatherId' => ['attribute' => 'fatherId']
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
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function testGetById()
    {
        $this->post($this->api, $this->item1);
        $last = $this->dao->findLastInserted();
        $response = $this->get($this->api . '&id=' . $last['category_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('category-test-105', $data->code);
        $this->assertEquals('Category Test 105', $data->name);
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
        $response = $this->delete($this->api . '&id=' . $last['category_id']);
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $response = $this->get($this->api . '&id=' . $last['category_id']);
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
        $this->item1->code = 'category-test-105-put';
        $this->item1->name = 'Category Test 105 put';
        $response = $this->put($this->api . '&id=' . $last['category_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('category-test-105-put', $data->code);
        $this->assertEquals('Category Test 105 put', $data->name);
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
        $response = $this->put($this->api . '&id=' . $last['category_id'], $this->item1);
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
        $response = $this->put($this->api . '&id=' . $last['category_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CONFLICT, $response->getStatusCode());
        $this->assertEquals('O seguinte atributo já está cadastrado: ' . $attribute, $data);
    }

    public function dataProviderHasExistAttributeTest(): array
    {
        return [
            'testingExistingCode' => ['attribute' => 'code'],
            'testingExistingName' => ['attribute' => 'name'],
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
        $response = $this->put($this->api . '&id=' . $last['category_id'], $this->item1);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
    }

    public function testDeleteBrandLinkedInProduct()
    {
        $this->insertOnDbProductTest145();
        $response = $this->delete($this->api . '&id=105');
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Este atributo já está vinculado com um produto!', $data);
    }

    public function deleteBrands(): void
    {
        $db = new Database();
        $db->delete("DELETE FROM category WHERE category_code = :category", array('category' => 'category-test-105'));
        $db->delete("DELETE FROM category WHERE category_code = :category", array('category' => 'category-test-106'));
        $db->delete("DELETE FROM category WHERE category_code = :category", array('category' => 'category-test-105-put'));
    }
}