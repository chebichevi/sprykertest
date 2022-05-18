<?php

declare(strict_types=1);

use App\UseCase\Cities\GetCities;

use function PHPUnit\Framework\assertCount;

it(
    'finds all cities',
    function (): void {
        $wheatherApiUrl = 'http://api.weatherapi.com/';
        $musementApiUrl = 'https://api.musement.com/';
        $wheatherApiKey = '48877761a22f46ca8d1163511221205';

        $getCities = self::$container->get(GetCities::class);
        assert($getCities instanceof GetCities);

        $result = $getCities->cities(
            $musementApiUrl,
            $wheatherApiUrl,
            $wheatherApiKey,
            ['offset' => 0, 'limit' => 2]
        );
        assertCount(2, $result);
    }
)
    ->group('cities');
