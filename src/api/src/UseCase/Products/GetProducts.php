<?php

declare(strict_types=1);

namespace App\UseCase\Products;

use App\Domain\Dao\ProductDao;
use App\Domain\ResultIterator\ProductResultIterator;

class GetProducts
{
    private ProductDao $productDao;

    public function __construct(ProductDao $productDao)
    {
        $this->productDao = $productDao;
    }

    public function products(
        ?string $productId,
        ?string $productName,
        ?string $partNumber,
        ?string $price
    ): ProductResultIterator {
        return $this->productDao->search(
            productId: $productId,
            productName: $productName,
            partNumber: $partNumber,
            price: $price
        );
    }
}
