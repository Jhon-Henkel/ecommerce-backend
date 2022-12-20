<?php

namespace tests\Feature\Api;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use src\DAO\ColorDAO;
use src\Database;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
use tests\Traits\ColorTraits;
use tests\Traits\HttpRequestTrait;

class ApiColorFeatureTest extends TestCase
{
    use ColorTraits, HttpRequestTrait;

    public \stdClass $color94;
    public \stdClass $color95;
    public \stdClass $color96;
    public ColorDAO $colorDAO;
    public string $api;

    protected function setUp(): void
    {
        $this->api = 'api=color';
        $this->deleteColors();
        $this->color94 = $this->makeStdColorTest94();
        $this->color95 = $this->makeStdColorTest95();
        $this->color96 = $this->makeStdColorTest96();
        $this->colorDAO = new ColorDAO(TableEnum::COLOR);
    }

    protected function tearDown(): void
    {
        $this->deleteColors();
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPost()
    {
        $response = $this->post($this->api, $this->color95);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('color-test-95', $data->code);
        $this->assertEquals('Color Test', $data->name);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPostParametersInvalid(string $attribute)
    {
        $this->color95->$attribute = null;
        $response = $this->post($this->api, $this->color95);
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
        $this->color95->$attribute = $this->color96->$attribute;
        $this->post($this->api, $this->color96);
        $response = $this->post($this->api, $this->color95);
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
        unset($this->color95->$attribute);
        $response = $this->post($this->api, $this->color95);
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
        $this->post($this->api, $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        $response = $this->get($this->api . '&id=' .$last['color_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('color-test-95', $data->code);
        $this->assertEquals('Color Test', $data->name);
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
        $this->post($this->api, $this->color94);
        $response = $this->get($this->api);
        $beforeInsert = count(json_decode($response->getBody()));
        $this->post($this->api, $this->color95);
        $this->post($this->api, $this->color96);
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
        $this->post($this->api, $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        $response = $this->delete($this->api . '&id=' . $last['color_id']);
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $response = $this->get($this->api . '&id=' . $last['color_id']);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('Registro não encontrado!', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function testValidPut()
    {
        $this->post($this->api, $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        $this->color95->code = 'color-test-95-put';
        $this->color95->name = 'Color Test Put';
        $response = $this->put($this->api . '&id=' . $last['color_id'], $this->color95);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('color-test-95-put', $data->code);
        $this->assertEquals('Color Test Put', $data->name);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataProviderParametersInvalid
     */
    public function testPutParametersInvalid(string $attribute)
    {
        $this->post($this->api, $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        $this->color95->$attribute = null;
        $response = $this->put($this->api . '&id=' . $last['color_id'], $this->color95);
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
        $this->post('api=color', $this->color96);
        $this->post('api=color', $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        $this->color95->$attribute = $this->color96->$attribute;
        $response = $this->put('api=color&id=' . $last['color_id'], $this->color95);
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
        $this->post('api=color', $this->color95);
        $colorDAO = new ColorDAO(TableEnum::COLOR);
        $last = $colorDAO->findLastInserted();
        unset($this->color95->$attribute);
        $response = $this->put('api=color&id=' . $last['color_id'], $this->color95);
        $data = json_decode($response->getBody());
        $this->assertEquals(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Atributos obrigatórios ausentes, revise a documentação!', $data);
    }

    public function deleteColors():void
    {
        $db = new Database();
        $db->delete("DELETE FROM color WHERE color_code = :color", array('color' => 'color-test-94'));
        $db->delete("DELETE FROM color WHERE color_code = :color", array('color' => 'color-test-95'));
        $db->delete("DELETE FROM color WHERE color_code = :color", array('color' => 'color-test-95-put'));
        $db->delete("DELETE FROM color WHERE color_code = :color", array('color' => 'color-test-96'));
    }
}