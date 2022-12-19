<?php

namespace tests\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Request;

trait HttpRequestTrait
{
    /**
     * @throws GuzzleException
     */
    public function post(string $route, object $object): Request
    {
        $client = new Client();
        return $client->request(
            'POST',
            'http://localhost/?' . $route,
            [
                'body' => json_encode($object),
                'http_errors' => false
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function put(string $route, object $object): Request
    {
        $client = new Client();
        return $client->request(
            'PUT',
            'http://localhost/?' . $route,
            [
                'body' => json_encode($object),
                'http_errors' => false
            ]
        );
    }

    public function get(string $route): Request
    {
        $client = new Client();
        return $client->request(
            'GET',
            'http://localhost/?' . $route,
            [
                'http_errors' => false
            ]
        );
    }

    public function delete(string $route): Request
    {
        $client = new Client();
        return $client->request(
            'DELETE',
            'http://localhost/?' . $route,
            [
                'http_errors' => false
            ]
        );
    }
}