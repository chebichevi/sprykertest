<?php

declare(strict_types=1);

namespace App\Domain\Throwable;

use InvalidArgumentException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class Violations extends InvalidArgumentException
{
    /** @var ConstraintViolationListInterface<ConstraintViolationInterface> */
    private ConstraintViolationListInterface $violations;

    /**
     * @param ConstraintViolationListInterface<ConstraintViolationInterface> $constraintViolationList
     */
    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        parent::__construct('Validation failed');
        $this->violations = $constraintViolationList;
    }

    /**
     * @return ConstraintViolationListInterface<ConstraintViolationInterface>
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }

    public function hasViolations(): bool
    {
        return ! empty($this->violations);
    }

    /**
     * @param ConstraintViolationListInterface<ConstraintViolationInterface> $constraintViolationList
     */
    public static function throwException(ConstraintViolationListInterface $constraintViolationList): void
    {
        if ($constraintViolationList->count() > 0) {
            throw new self($constraintViolationList);
        }
    }
}
