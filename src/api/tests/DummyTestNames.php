<?php

declare(strict_types=1);

namespace App\Tests;

final class DummyTestNames
{
    public const REQUEST_NOT_FOUND                                = 'no resource found';
    public const ALLOWS_THE_REQUEST                               = 'allows the request';
    public const FORBIDS_THE_REQUEST                              = 'forbids request';
    public const THROWS_AN_EXCEPTION_IF_INVALID_REQUEST           = 'throws an exception if invalid request';
    public const THROWS_AN_EXCEPTION_IF_INVALID_CHOICE_IN_REQUEST = 'throws an exception if invalid choice in request';
    public const RETURNS_NOT_FOUND                                = 'returns not found';
    public const HANDLES_THE_REQUEST                              = 'handles the request';
}
