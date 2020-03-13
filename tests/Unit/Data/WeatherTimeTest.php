<?php

namespace Tests\Unit\Data;

use ArgumentCountError;
use Tests\TestCase;
use App\Data\WeatherTime;

/**
 * Class testing the relevant methods of the WeatherTime class
 */
class WeatherTimeTest extends TestCase
{
    /** @var array $expectedArray Demo city weather data in array format  */
    static $expectedArray = [
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
    ];

    /**
     * Can get the data in array format
     *
     * @return void
     */
    public function testToArray()
    {
        $weather = new WeatherTime('2020-03-13 03:00:00', '3');
        $weather->setWeather('Clouds');
        $weather->setDescription('overcast clouds');
        $weather->setClouds(100);
        $weather->setHumidity(70);
        $weather->setPressure(1017);
        $weather->setTemp(12.53);
        $weather->setFeelsLike(11.09);
        $weather->setTempMin(12.53);
        $weather->setTempMax(13.87);
            
        $this->assertEquals($weather->toArray(), self::$expectedArray);
    }

    /**
     * Fail creating WeatherTime
     *
     * @return void
     */
    public function testFailCreate()
    {
        $this->expectException(ArgumentCountError::class);
        $weather = new WeatherTime('2020-03-13 04:00:00');
    }
}
