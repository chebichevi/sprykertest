<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

/**
 * Interface Command
 * @package App\Commands
 */
interface Command
{
    /**
     *
     */
    public function up(): void;

    /**
     * @return string
     */
    public function getName(): string;
}
