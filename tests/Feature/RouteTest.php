<?php

namespace Tests\Unit\RouteTest;

use ArgumentCountError;
use Tests\TestCase;
use App\Data\Weather;
use App\Http\Services\OpenWeatherMapApiClient;

/**
 * Class testing the relevant methods of the OpenWeatherMapApiClientTest class
 */
class OpenWeatherMapApiClientTest extends TestCase
{
    /**
     * Integration Test the method getWeatherForecast
     *
     * @return void
     */
    public function testGetWeatherForecast()
    {
        $client = new OpenWeatherMapApiClient();
        $weather = $client->getWeatherForecast('UK', 'Manchester', 'en', 'metric');

        $this->assertTrue($weather instanceof Weather);
    }

    /**
     * Test index endpoint
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->get('/')->assertStatus(200);   
    }

    /**
     * Invalid city, should result in 404
     *
     * @return void
     */
    public function testFailInvalidCityApiWeather()
    {
        $this->get('/api/v1/weather/ES/whatever')->assertStatus(404);   
    }

    /**
     * Test Weather API endpoing
     *
     * @return void
     */
    public function testApiWather()
    {
        $this->get('/api/v1/weather/ES/madrid')->assertStatus(200);   
    }
}