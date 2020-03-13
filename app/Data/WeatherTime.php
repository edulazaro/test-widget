<?php

namespace App\Data;

/**
 * Data transfer object for a weather range of time
 * 
 * Used to make the data output consistent
 */
class WeatherTime
{
    /** @var string $date The weather date and time  */
    private $date;

    /** @var int $hours The prediction duration in hours  */
    private $hours;

    /** @var string $weather General weather  */
    private $weather;

    /** @var string $description Weather description  */
    private $description;

    /** @var int $clouds Clouds percentage  */
    private $clouds;

    /** @var float $windSpeed Wind speed  */
    private $windSpeed;

    /** @var int $windDirection Wind direction  */
    private $windDirection;

    /** @var int $humidity Wather humidity percentage  */
    private $humidity;

    /** @var int $pressure Wather pressure */
    private $pressure;

    /** @var float $temp The temperature */
    private $temp;

    /** @var float $feelsLike The temperature feeling  */
    private $feelsLike;

    /** @var float $tempMin The minimum temperature  */
    private $tempMin;

    /** @var float $tempMax The maximum temperature  */
    private $tempMax;

    /**
     * Class constructor
     * 
     * @param string $date The weather date and time
     * @param string $hours The prediction duration in hours
     */
    public function __construct($date, $hours)
    {
        $this->date = $date;
        $this->hours = $hours;
    }

    /**
     * Set weather
     * 
     * @param string $weather
     * @return void
     */
    public function setWeather($weather)
    {
        $this->weather = $weather;
    }

    /**
     * Set description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set clouds
     * 
     * @param int $clouds
     * @return void
     */
    public function setClouds($clouds)
    {
        $this->clouds = $clouds;
    }

    /**
     * Set windSpeed
     * 
     * @param float $windSpeed
     * @return void
     */
    public function setWindSpeed($windSpeed)
    {
        $this->windSpeed = $windSpeed;
    }

    /**
     * Set windDirection
     * 
     * @param int $windDirection
     * @return void
     */
    public function setWindDirection($windDirection)
    {
        $this->windDirection = $windDirection;
    }

    /**
     * Set humidity
     * 
     * @param int $humidity
     * @return void
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    /**
     * Set pressure
     * 
     * @param int $pressure
     * @return void
     */
    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }

    /**
     * Set temp
     * 
     * @param float $temp
     * @return void
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }
    
    /**
     * Set feelsLike
     * 
     * @param float $feelsLike
     * @return void
     */
    public function setFeelsLike($feelsLike)
    {
        $this->feelsLike = $feelsLike;
    }
    
    /**
     * Set tempMin
     * 
     * @param float $tempMin
     * @return void
     */
    public function setTempMin($tempMin)
    {
        $this->tempMin = $tempMin;
    }
    
    /**
     * Set tempMax
     * 
     * @param float $tempMax
     * @return void
     */
    public function setTempMax($tempMax)
    {
        $this->tempMax = $tempMax;
    }

    /**
     * Object to array
     * 
     * @return array
     */
    public function toArray()
    {
        $array = [
            'date' => $this->date,
            'hours' => $this->hours,
        ];

        if ($this->weather !== null ) $array['weather'] = $this->weather;

        if ($this->description !== null) $array['description'] = $this->description;

        if ($this->clouds !== null) $array['clouds'] = $this->clouds;

        if ($this->windSpeed !== null) $array['windSpeed'] = $this->windSpeed;

        if ($this->windDirection !== null) $array['windDirection'] = $this->windDirection;

        if ($this->humidity !== null) $array['humidity'] = $this->humidity;

        if ($this->pressure !== null) $array['pressure'] = $this->pressure;

        if ($this->temp !== null) $array['temp'] = $this->temp;

        if ($this->feelsLike !== null) $array['feelsLike'] = $this->feelsLike;

        if ($this->tempMin !== null) $array['tempMin'] = $this->tempMin;

        if ($this->tempMax !== null) $array['tempMax'] = $this->tempMax;

        return $array;
    }
}