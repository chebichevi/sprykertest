<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Products;

use App\Domain\Dao\ProductDao;
use App\Infrastructure\Command\ImportProductData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class ImportProductsController extends AbstractController
{
    private ProductDao $productDao;
    private ImportProductData $importProductData;

    public function __construct(
        ProductDao $productDao,
        ImportProductData $importProductData
    ) {
        $this->productDao        = $productDao;
        $this->importProductData = $importProductData;
    }

    #[Route('/api/products/import', methods: ['GET'])]
    public function importProducts(Request $request): JsonResponse
    {
        $this->importProductData->up();
        $products = $this->productDao->findAll();

        return new JsonResponse([
            'items' => $products->toArray(),
            'count' => $products->count(),
        ]);
    }
}
