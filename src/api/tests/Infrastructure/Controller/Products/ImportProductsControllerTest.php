<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Controller\Products;

use App\Tests\DummyTestNames;

use function it;

it(
    DummyTestNames::REQUEST_NOT_FOUND,
    function (): void {
        $this->assertRequestNotFound('GET', '/api/products/foo');
    }
)->group('products');

it(
    DummyTestNames::HANDLES_THE_REQUEST,
    function (): void {
        $this->assertSuccessRequest('GET', '/api/products/import');
    }
)->group('products');
