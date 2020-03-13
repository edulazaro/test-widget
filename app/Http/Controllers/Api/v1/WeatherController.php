<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Controller;
use App\Http\Services\WeatherClientInterface;

/**
 * Weather controller
 */
class WeatherController extends Controller
{
    /** @var WeatherClientInterface $weatherClient Weather service */
    private $weatherClient;

    /**
     * Class constructor
     * 
     * @param WeatherClientInterface $weatherClient Weather API service
     */
    public function __construct(WeatherClientInterface $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * Get weather forecast
     *
     * @param string $country The selected country
     * @param string $city The selected city
     * @return string JSON
     */
    public function getWeatherForecast($country, $city)
    {
        try {
            $weather = $this->weatherClient->getWeatherForecast($country, $city);
            return response()->json([
                'error' => false,
                'data' => $weather->toArray()
            ]);
        } catch (Exception $exception) {
            abort($exception->getStatusCode(), $exception->getMessage());
        } 
	}
}
