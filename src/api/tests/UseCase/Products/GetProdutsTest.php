<?php

declare(strict_types=1);

use App\UseCase\Products\GetProducts;

use function PHPUnit\Framework\assertCount;

it(
    'finds all products',
    function (): void {
        $this->createFakeProduct();
        $this->createFakeProduct();

        $getProducts = self::$container->get(GetProducts::class);
        assert($getProducts instanceof GetProducts);

        $result = $getProducts->products(
            '111',
            'foo',
            'pr-111',
            '333',
        );
        assertCount(2, $result);
    }
)
    ->group('products');
