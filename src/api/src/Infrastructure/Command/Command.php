<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

interface Command
{
    public function up(): void;

    public function getName(): string;
}
