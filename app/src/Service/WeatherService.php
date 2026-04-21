<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {}

    public function getCurrentTemperature(): ?float
    {
        try {
            return (float) $this->httpClient
                ->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=15.87944&longitude=108.335&current=temperature_2m&timezone=Asia/Bangkok&temperature_unit=celsius')
                ->toArray()["current"]["temperature_2m"];
        } catch (\Throwable) {
            return null;
        }
    }
}
