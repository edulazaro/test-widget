<?php

namespace App\Http\Services;

interface WeatherClientInterface
{
    /**
     * Get the forecast of the specified city
     * 
     * @param array|int|string $query
     * @param string $lang
     * @param string $units
     * @param int $days
     * @return OpenWeatherMap\WeatherForecast
     */
    public function getWeatherForecast($query, $lang, $units, $days);
}