<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Products;

use App\Infrastructure\Command\ImportProductData;
use App\Domain\Dao\ProductDao;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use function strval;

final class ImportProductsController extends AbstractController
{
    private ProductDao $ProductDao;
    private ImportProductData $importProductData;

    public function __construct(
        ProductDao $ProductDao,
        ImportProductData $importProductData
    )
    {
        $this->productDao = $productDao;
        $this->importProductData = $importProductData;
    }

    #[Route('/api/products/import', methods: ['POST'])]
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
