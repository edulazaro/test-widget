<?php

namespace Tests\Unit\Feature;

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
}
