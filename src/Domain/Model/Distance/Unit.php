<?php

declare(strict_types = 1);

namespace App\Domain\Model\Distance;

final class Unit
{
    private const METERS = 'Meters';
    private const YARDS  = 'Yards';

    private string $name;

    public function __construct(string $name)
    {
        if ($name !== 'Meters' && $name !== 'Yards') {
            throw new \InvalidArgumentException("Wrong unit: $name");
        }

        $this->name = $name;
    }

    public function equals(self $unit): bool
    {
        return $this->name === $unit->name;
    }

    public function isMeter(): bool
    {
        return $this->name === self::METERS;
    }

    public function isYard(): bool
    {
        return $this->name === self::YARDS;
    }

    public static function meter(): self
    {
        return new self(self::METERS);
    }

    public static function yard(): self
    {
        return new self(self::YARDS);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}