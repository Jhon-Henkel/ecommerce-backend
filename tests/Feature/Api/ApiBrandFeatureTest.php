<?php

namespace tests\Feature\Api;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use src\DAO\BrandDAO;
use src\Database;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
use stdClass;
use tests\Traits\BrandTraits;
use tests\Traits\HttpRequestTrait;
use tests\Traits\ProductTraits;

class ApiBrandFeatureTest extends TestCase
{
    use BrandTraits, HttpRequestTrait, ProductTraits;

    public stdClass $brand98;
    public stdClass $brand99;
    public BrandDAO $brandDAO;
    public string $api;

    protected function setUp(): void
    {
        $this->api = 'api=brand';
        $this->deleteBrands();
        $this->deleteOnDbProductTest145();
        $this->brand98 = $this->makeStdBrandTest98();
        $this->brand99 = $this->makeStdBrandTest99();
        $this->brandDAO = new BrandDAO(TableEnum::BRAND);
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
        $response = $this->post($this->api, $this->brand99);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('brand-test-99', $data->code);
        $this->assertEquals('Brand Test Feature Test 99', $data->name);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPostParametersInvalid(string $attribute)
    {
        $this->brand99->$attribute = null;
        $response = $this->post($this->api, $this->brand99);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('O valor para o seguinte campo é inválido: ' . $attribute, $data);
    }

    public function dataProviderParametersInvalid(): array
    {
        return [
            'testingNullCode' => ['attribute' => 'code'],
            'testingNullName' => ['attribute' => 'name'],
        ];
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderHasExistAttributeTest
     */
    public function testDoublePost(string $attribute)
    {
        $this->brand99->$attribute = $this->brand98->$attribute;
        $this->post($this->api, $this->brand98);
        $response = $this->post($this->api, $this->brand99);
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
        unset($this->brand99->$attribute);
        $response = $this->post($this->api, $this->brand99);
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
        $this->post($this->api, $this->brand99);
        $last = $this->brandDAO->findLastInserted();
        $response = $this->get($this->api . '&id=' . $last['brand_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('brand-test-99', $data->code);
        $this->assertEquals('Brand Test Feature Test 99', $data->name);
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
        $this->post($this->api, $this->brand99);
        $this->post($this->api, $this->brand98);
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
        $this->post($this->api, $this->brand99);
        $last = $this->brandDAO->findLastInserted();
        $response = $this->delete($this->api . '&id=' . $last['brand_id']);
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $response = $this->get($this->api . '&id=' . $last['brand_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('Registro não encontrado!', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPut()
    {
        $this->post($this->api, $this->brand99);
        $last = $this->brandDAO->findLastInserted();
        $this->brand99->code = 'brand-test-99-put';
        $this->brand99->name = 'Brand Test 99 Put';
        $response = $this->put($this->api . '&id=' . $last['brand_id'], $this->brand99);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('brand-test-99-put', $data->code);
        $this->assertEquals('Brand Test 99 Put', $data->name);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPutParametersInvalid(string $attribute)
    {
        $this->post($this->api, $this->brand99);
        $last = $this->brandDAO->findLastInserted();
        $this->brand99->$attribute = null;
        $response = $this->put($this->api . '&id=' . $last['brand_id'], $this->brand99);
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
        $this->post($this->api, $this->brand99);
        $this->post($this->api, $this->brand98);
        $last = $this->brandDAO->findLastInserted();
        $this->brand98->$attribute = $this->brand99->$attribute;
        $response = $this->put($this->api . '&id=' . $last['brand_id'], $this->brand98);
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
        $this->post($this->api, $this->brand99);
        $last = $this->brandDAO->findLastInserted();
        unset($this->brand99->$attribute);
        $response = $this->put($this->api . '&id=' . $last['brand_id'], $this->brand99);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
    }

    public function testDeleteBrandLinkedInProduct()
    {
        $this->insertOnDbProductTest145();
        $response = $this->delete($this->api . '&id=99');
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Este atributo já está vinculado com um produto!', $data);
    }

    public function deleteBrands(): void
    {
        $db = new Database();
        $db->delete("DELETE FROM brand WHERE brand_code = :brand", array('brand' => 'brand-test-98'));
        $db->delete("DELETE FROM brand WHERE brand_code = :brand", array('brand' => 'brand-test-99'));
        $db->delete("DELETE FROM brand WHERE brand_code = :brand", array('brand' => 'brand-test-99-put'));
    }
}