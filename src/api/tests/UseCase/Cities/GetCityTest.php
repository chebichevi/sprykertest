<?php

declare(strict_types=1);

use App\UseCase\Cities\GetCity;

use function PHPUnit\Framework\assertSame;

it(
    'finds special city',
    function (): void {
        $wheatherApiUrl = 'http://api.weatherapi.com/';
        $musementApiUrl = 'https://api.musement.com/';
        $wheatherApiKey = '48877761a22f46ca8d1163511221205';

        $getCity = self::$container->get(GetCity::class);
        assert($getCity instanceof GetCity);

        $result = $getCity->city(
            $musementApiUrl,
            $wheatherApiUrl,
            $wheatherApiKey,
            '1'
        );

        assertSame(1, $result->id);
    }
)
    ->group('city');
