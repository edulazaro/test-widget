<?php

namespace App\Data;

/**
 * Data transfer object for the weather
 * 
 * Used to make the data output consistent
 */
class WeatherCity
{

    /** @var string $name The city name  */
    private $name;

    /** @var string $country The country name  */
    private $country;

    /** @var float $lat The city latitude positioning */
    private $latitude;

    /** @var float $longitude The city longitude positioning  */
    private $longitude;

    /** @var int $population The city population  */
    private $population;

    /** @var int $timezone The city timezone  */
    private $timezone;

    /** @var int $sunrise The city sunrise time  */
    private $sunrise;

    /** @var int $sunset The city sunset time  */
    private $sunset;

    /**
     * Class constructor
     * 
     * @param string $city The city name
     */
    public function __construct($name, $country)
    {
        $this->name = $name;
        $this->country = $country;
    }

    /**
     * Set city latitude
     * 
     * @param float $latitude
     * @return void
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Set city longitude
     * 
     * @param float $longitude
     * @return void
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Set city population
     * 
     * @param int $population
     * @return void
     */
    public function setPopulation($population)
    {
        $this->population = $population;
    }

    /**
     * Set city timezone
     * 
     * @param int $timezone
     * @return void
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * Set city sunrise
     * 
     * @param int $sunrise
     * @return void
     */
    public function setSunrise($sunrise)
    {
        $this->sunrise = $sunrise;
    }

    /**
     * Set city sunset
     * 
     * @param int $sunset
     * @return void
     */
    public function setSunset($sunset)
    {
        $this->sunset = $sunset;
    }

    /**
     * Object to array
     * 
     * @return array
     */
    public function toArray()
    {
        $array = [
            'name' => $this->name,
            'country' => $this->country,
        ];

        if ($this->latitude !== null ) $array['latitude'] = $this->latitude;

        if ($this->longitude !== null) $array['longitude'] = $this->longitude;

        if ($this->population !== null) $array['population'] = $this->population;

        if ($this->timezone !== null) $array['timezone'] = $this->timezone;

        if ($this->sunrise !== null) $array['sunrise'] = $this->sunrise;

        if ($this->sunset !== null) $array['sunset'] = $this->sunset;

        return $array;
    }
}