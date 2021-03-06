<?php

declare(strict_types=1);

use App\Tests\UseCase\UseCaseTestCase;

uses(UseCaseTestCase::class)->in('Infrastructure/Controller');
uses(UseCaseTestCase::class)->in('UseCase');
