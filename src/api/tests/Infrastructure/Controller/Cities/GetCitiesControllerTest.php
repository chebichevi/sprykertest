<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Controller\Cities;

use App\Tests\DummyTestNames;

use function it;

it(
    DummyTestNames::REQUEST_NOT_FOUND,
    function (): void {
        $this->assertRequestNotFound('GET', '/api/v3/citieses');
    }
)->group('cities');

it(
    DummyTestNames::HANDLES_THE_REQUEST,
    function (): void {
        $this->assertSuccessRequest('GET', '/api/v3/cities');
    }
)->group('cities');
