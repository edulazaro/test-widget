<?php

namespace Tests\Unit\Data;

use ArgumentCountError;
use Tests\TestCase;
use App\Data\Weather;
use App\Data\WeatherCity;
use App\Data\WeatherTime;


/**
 * Class testing the relevant methods of the Weather class
 */
class WeatherTest extends TestCase
{
    /** @var array $expectedArray Demo weather data in array format  */
    static $expectedArray = [
        'city'=> [
            'name'=> 'Manchester',
            'country'=> 'UK',
            'latitude' => 53.4809,
            'longitude' => -2.2374,
            'population' => 510746,
            'timezone' => 0,
            'sunrise' => 1584080858,
            'sunset' => 1584122950,
        ],
        'list'=> [
            [
                'date'=> '2020-03-13 03:00:00',
                'hours'=> '3',
                'weather'=> 'Clouds',
                'description'=> 'overcast clouds',
                'clouds'=> 100,
                'humidity'=> 70,
                'pressure'=> 1017,
                'temp'=> 12.53,
                'feelsLike'=> 11.09,
                'tempMin'=> 12.53,
                'tempMax'=> 13.87,
            ]
        ],
    ];

    /**
     * Can get the data in array format
     *
     * @return void
     */
    public function testToArray()
    {
        $city = new WeatherCity('Manchester', 'UK');
        $city->setLatitude(53.4809);
        $city->setLongitude(-2.2374);
        $city->setPopulation(510746);
        $city->setTimezone(0);
        $city->setSunrise(1584080858);
        $city->setSunset(1584122950);

        $weatherTime = new WeatherTime('2020-03-13 03:00:00', '3');
        $weatherTime->setWeather('Clouds');
        $weatherTime->setDescription('overcast clouds');
        $weatherTime->setClouds(100);
        $weatherTime->setHumidity(70);
        $weatherTime->setPressure(1017);
        $weatherTime->setTemp(12.53);
        $weatherTime->setFeelsLike(11.09);
        $weatherTime->setTempMin(12.53);
        $weatherTime->setTempMax(13.87);

        $list = [$weatherTime];
            
        $weather = new Weather($city, $list);

        $this->assertEquals($weather->toArray(), self::$expectedArray);
    }

    /**
     * Can get the data in array format
     *
     * @return void
     */
    public function testFailToArray()
    {
        $city = new WeatherCity('Madrid', 'ES');
        $city->setLatitude(53.4809);
        $city->setLongitude(-2.2374);
        $city->setPopulation(510746);
        $city->setTimezone(0);
        $city->setSunrise(1584080858);
        $city->setSunset(1584122950);

        $weatherTime = new WeatherTime('2020-03-13 03:00:00', '3');
        $weatherTime->setWeather('Clouds');
        $weatherTime->setDescription('overcast clouds');
        $weatherTime->setClouds(100);
        $weatherTime->setHumidity(80);
        $weatherTime->setPressure(1017);
        $weatherTime->setTemp(12.53);
        $weatherTime->setFeelsLike(11.09);
        $weatherTime->setTempMin(12.53);
        $weatherTime->setTempMax(13.87);

        $list = [$weatherTime];
            
        $weather = new Weather($city, $list);

        $this->assertNotEquals($weather->toArray(), self::$expectedArray);
    }

    /**
     * Fail creating Weather
     *
     * @return void
     */
    public function testFailCreate()
    {
        $this->expectException(ArgumentCountError::class);
        $city = new WeatherCity('Madrid', 'ES');
        $weather = new Weather($city);
    }
}
