<?php

namespace Tests\Unit\Data;

use ArgumentCountError;
use Tests\TestCase;
use App\Data\WeatherCity;

/**
 * Class testing the relevant methods of the WeatherCity class
 */
class WeatherCityTest extends TestCase
{
    /** @var array $expectedArray Demo city data in array format  */
    static $expectedArray = [
        'name'=> 'Manchester',
        'country'=> 'UK',
        'latitude' => 53.4809,
        'longitude' => -2.2374,
        'population' => 510746,
        'timezone' => 0,
        'sunrise' => 1584080858,
        'sunset' => 1584122950,
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
            
        $this->assertEquals($city->toArray(), self::$expectedArray);
    }

    /**
     * Fail creating WeatherCity
     *
     * @return void
     */
    public function testFailCreate()
    {
        $this->expectException(ArgumentCountError::class);
        $city = new WeatherCity('Madrid');
    }
}
