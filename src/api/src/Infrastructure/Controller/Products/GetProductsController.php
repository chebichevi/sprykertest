<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Products;

use App\Domain\Throwable\InvalidRequest;
use App\UseCase\Products\GetProducts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function count;

final class GetProductsController extends AbstractController
{
    private ValidatorInterface $validator;
    private GetProducts $getProducts;

    private int $limit  = 0;
    private int $offset = 0;

    public function __construct(
        ValidatorInterface $validator,
        GetProducts $getProducts
    ) {
        $this->validator   = $validator;
        $this->getProducts = $getProducts;
    }

    /**
     * @throws InvalidRequest
     */
    #[Route('/api/products', methods: ['GET'])]
    public function products(Request $request): JsonResponse
    {
        $filters    = [
            'all' => $request->query->getBoolean('all', false),
            'offset' => $request->query->getInt('offset', 0),
            'limit' => $request->query->getInt('limit', 10),
            'productId' => $request->query->get('productId'),
            'productName' => $request->query->get('productName'),
            'partNumber' => $request->query->get('partNumber'),
            'price' => $request->query->get('price'),
        ];
        $constraint = new Assert\Collection([
            'all' => new Assert\Optional(),
            'offset' => new Assert\PositiveOrZero(),
            'limit' => new Assert\Positive(),
            'productId' => new Assert\Optional([new Assert\Type('string')]),
            'productName' => new Assert\Optional([new Assert\Type('string')]),
            'partNumber' => new Assert\Optional([new Assert\Type('string')]),
            'price' => new Assert\Optional([new Assert\Type('string')]),
        ]);

        $violations = $this->validator->validate($filters, $constraint);
        InvalidRequest::throwException($violations);

        $this->limit  = $filters['limit'];
        $this->offset = $filters['offset'] ?? 0;

        $products = $this->getProducts->products(
            productId: $filters['productId'],
            productName: $filters['productName'],
            partNumber: $filters['partNumber'],
            price: $filters['price']
        )->jsonSerialize();

        return new JsonResponse([
            'items' => $products,
            'count' => count($products),
        ]);
    }
}
