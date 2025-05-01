<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WeatherControllerTest extends WebTestCase
{
    public function testFetchWeather(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/weather/fetch', [
            'lat' => 47.32,
            'lon' => 5.04,
            'city' => 'Dijon',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetWeather(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/weather');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }
}
