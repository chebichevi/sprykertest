<?php

declare(strict_types=1);

namespace App\Domain\Throwable;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class InvalidRequest extends Violations implements APIRule
{
    /**
     * @param ConstraintViolationListInterface<ConstraintViolationInterface> $constraintViolationList
     *
     * @throws InvalidRequest
     */
    public static function throwException(ConstraintViolationListInterface $constraintViolationList): void
    {
        if ($constraintViolationList->count() > 0) {
            throw new self($constraintViolationList);
        }
    }
}
