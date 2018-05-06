<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetCard()
    {
        $client = static::createClient();
        $client->request('GET', '/api/public/card/01001');
        $response = $client->getResponse();
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertNotNull($data);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey("code", $data);
        $this->assertEquals("01001", $data['code']);
    }

    public function testListCards()
    {
        $client = static::createClient();
        $client->request('GET', '/api/public/cards/');
        $response = $client->getResponse();
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertNotNull($data);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }
    
    public function testListCardsBySet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/public/cards/Core');
        $response = $client->getResponse();
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertNotNull($data);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey("set_code", $item);
            $this->assertEquals("Core", $item['set_code']);
        }
    }
    
    public function testListSets()
    {
        $client = static::createClient();
        $client->request('GET', '/api/public/sets/');
        $response = $client->getResponse();
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertNotNull($data);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    public function testGetDecklist()
    {
        $client = static::createClient();
        $client->request('GET', '/api/public/decklist/1');
        $response = $client->getResponse();
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertNotNull($data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey("id", $data);
        $this->assertEquals(1, $data['id']);
    }
}
