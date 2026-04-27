<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class WeatherService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $weatherCache,
    ) {}

    public function getCurrentTemperature(): ?float
    {
        return $this->weatherCache->get('weather_temperature_hoian', function (ItemInterface $item) {
            try {
                return (float)$this->httpClient
                    ->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=15.87944&longitude=108.335&current=temperature_2m&timezone=Asia/Bangkok&temperature_unit=celsius')
                    ->toArray()["current"]["temperature_2m"];
            } catch (\Throwable) {
                return null;
            }
        });
    }
}
