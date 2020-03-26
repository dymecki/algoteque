<?php

declare(strict_types = 1);

namespace App\Domain\Model\Distance;

final class Length
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Length cannot be negative');
        }

        $this->value = round($value, 2);
    }

    public function sum(self $length): self
    {
        return new self($this->value + $length->value);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}