<?php

namespace App\Data;

use App\Data\WeatherCity;

/**
 * Data transfer object for the weather
 * 
 * Used to make the data output consistent
 */
class Weather {

    /** @var WeatherCity $city The city information  */
    private $city;

    /** @var WeatherTime[] $list The weather rows  */
    private $list;

    /**
     * Class constructor
     * 
     * @param WeatherCity $city The general city weather data
     * @param WeatherTime[] $list The weather data list
     */
    public function __construct($city, $list)
    {
        $this->city = $city;
        $this->list = $list;
    }

    /**
     * Get city data
     * 
     * @return WeatherCity
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Get weather data list
     * 
     * @return WeatherTime[]
     */
    public function getList() {
        return $this->list;
    }

    /**
     * Object to array
     * 
     * @return array
     */
    public function toArray()
    {
        $timeList = [];

        foreach ($this->list as $time) {
            $timeList[] = $time->toArray();
        }

        return [
            'city' => $this->city->toArray(),
            'list' => $timeList
        ];
    }
}