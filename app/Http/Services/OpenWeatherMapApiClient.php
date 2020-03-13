<?php

namespace App\Http\Services;

use Cache;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use App\Data\Weather;
use App\Data\WeatherCity;
use App\Data\WeatherTime;

/**
 * Class to interact with the OpenWeatherMap class
 */
class OpenWeatherMapApiClient implements WeatherClientInterface
{
    /** @var array $config The configuration array */
    protected $config;

    /** @var string $apiKey The OpenWeatherMap API key */
    protected $apiKey;

    /** @var Client $client HTTP Client */
    protected $client;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->config = config('api.OpenWeatherMap');

        if ($this->config === null) throw new Exception('OpenWeatherMap config file was not found.');

        if ($this->config['api_key'] === null) throw new Exception('OpenWeatherMap API key was not found.');

        $this->apiKey = $this->config['api_key'];
    }

    /**
     * Parse weather array data and create Weather object
     * 
     * @param array $watherArray The weather API data in array format
     * @return Weather
     */
    private function parseWeather($watherInput)
    {
        if (!isset($watherInput->city)) throw new Exception('API ERROR: The city data is missing.');
        if (!isset($watherInput->list)) throw new Exception('API ERROR: The weather data is missing.');
    
        $watherCity = $this->parseWeatherCity($watherInput->city);

        $watherList = $this->parseWeatherTime($watherInput->list);
            
        $weather = app()->make(Weather::class, ['city' => $watherCity, 'list' => $watherList]);

        return $weather;
    }

    /**
     * Parse weather city  array data and create WeatherCity object
     * 
     * @param array $cityArray The city data in array format
     * @return WeatherCity
     */
    private function parseWeatherCity($city)
    {
        if (!isset($city->name)) throw new Exception('API ERROR: The city name is missing.');
        if (!isset($city->country)) throw new Exception('API ERROR: The country code is missing.');

        if (!isset(config('constants.countries')[$city->country])) {
            throw new Exception('API ERROR: The country code is missing in the server.');
        }

        $country = config('constants.countries')[$city->country];

        $weatherCity = app()->make(WeatherCity::class, ['name' => $city->name, 'country' => $country]);

        if (isset($city->coord)) {
            if (isset($city->coord->lat)) $weatherCity->setLatitude($city->coord->lat);
            if (isset($city->coord->lon)) $weatherCity->setLongitude($city->coord->lon);
        }

        if (isset($city->population)) $weatherCity->setPopulation($city->population);

        if (isset($city->timezone)) $weatherCity->setTimezone($city->timezone);

        if (isset($city->sunrise)) $weatherCity->setSunrise($city->sunrise);

        if (isset($city->sunset)) $weatherCity->setSunset($city->sunset);

        return $weatherCity;
    }

    /**
     * Create an array of WeatherTime objects
     * 
     * @param array $weatherTimeArray The wather at different times
     * @return WeatherTime[]
     */
    private function parseWeatherTime($timeArray)
    {
        $weatherTimeArray = [];

        foreach ($timeArray as $time) {

            if (!isset($time->dt_txt)) throw new Exception('API ERROR: The weather date is missing.');

            $weatherTime = app()->make(WeatherTime::class, ['date' => $time->dt_txt, 'hours' => 3]);

            if (isset($time->main)) {

                if (isset($time->main->temp)) $weatherTime->setTemp($time->main->temp);

                if (isset($time->main->feels_like)) $weatherTime->setFeelsLike($time->main->feels_like);

                if (isset($time->main->temp_min)) $weatherTime->setTempMin($time->main->temp_min);

                if (isset($time->main->temp_max)) $weatherTime->setTempMax($time->main->temp_max);

                if (isset($time->main->pressure)) $weatherTime->setPressure($time->main->pressure);

                if (isset($time->main->humidity)) $weatherTime->setHumidity($time->main->humidity);
            }

            if (isset($time->weather) && isset($time->weather[0])) {

                if (isset($time->weather[0]->main)) $weatherTime->setWeather($time->weather[0]->main);
                if (isset($time->weather[0]->description)) $weatherTime->setDescription($time->weather[0]->description);
            }

            if (isset($time->clouds)) {
                if (isset($time->clouds->all)) $weatherTime->setClouds($time->clouds->all);
            }

            if (isset($time->wind)) {;
                if (isset($time->wind->speed)) $weatherTime->setWindSpeed($time->wind->speed);
                if (isset($time->wind->deg)) $weatherTime->setWindDirection($time->wind->deg);
            }

            $weatherTimeArray[] = $weatherTime;
        }

        return $weatherTimeArray;
    }

    /**
     * Get the forecast of the specified city
     * 
     * @param string $country
     * @param string $city
     * @param string $lang
     * @param string $units
     * @param int $days
     * @return Weather
     */
    public function getWeatherForecast($country, $city, $lang = 'en', $units = 'metric')
    {
        try {
            $this->client = new Client([
                'base_uri' => 'http://api.openweathermap.org/data/2.5/',
                'timeout'  => 5.0,
            ]);

            $response = $this->client->request('GET', 'forecast', [
                'query' => [
                    'q' => $city . ',' . $country,
                    'units' => $units,
                    'lang' => $lang,
                    'APPID' =>  $this->apiKey
                ],
            ]);

        } catch (RequestException  $exception) {
            $response = json_decode($exception->getResponse()->getBody(), true);
            abort($response['cod'], $response['message']);
        }

        if (!$response || $response->getStatusCode() !== 200) throw new Exception('It was not possible to get wather information.');

        try {
            $dataArr = json_decode($response->getBody()->getContents());
            $weather = $this->parseWeather($dataArr); 
        } catch (Exception  $exception) {
            abort(500, $exception->getMessage());
        }

        return $weather;
    }
}