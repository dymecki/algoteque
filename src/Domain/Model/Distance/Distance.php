<?php

declare(strict_types = 1);

namespace App\Domain\Model\Distance;

final class Distance implements \JsonSerializable
{
    private Length $length;
    private Unit   $unit;

    public function __construct(Length $length, Unit $unit)
    {
        $this->length = $length;
        $this->unit   = $unit;
    }

    public static function fromStd(object $data): self
    {
        return new self(
            new Length($data->length),
            new Unit($data->unit)
        );
    }

    public static function fromMeters(float $length = 0): self
    {
        return new self(
            new Length($length),
            Unit::meter()
        );
    }

    public static function fromYards(float $length = 0): self
    {
        return new self(
            new Length($length),
            Unit::yard()
        );
    }

    public function sum(self $distance): self
    {
        if (!$this->unit->equals($distance->unit)) {
            throw new \InvalidArgumentException(
                'Cannot sum distances with different units'
            );
        }

        return new self(
            $this->length->sum($distance->length()),
            $this->unit
        );
    }

    public function toMeters(): Distance
    {
        return $this->unit()->isMeter() ? $this : self::fromMeters($this->length()->value() * 0.9144);
    }

    public function toYards(): Distance
    {
        return $this->unit()->isYard() ? $this : self::fromYards($this->length()->value() * 1.093_613);
    }

    public function length(): Length
    {
        return $this->length;
    }

    public function unit(): Unit
    {
        return $this->unit;
    }

    public function jsonSerialize(): array
    {
        return [
            'length' => $this->length->value(),
            'unit'   => $this->unit->name()
        ];
    }

    public function __toString(): string
    {
        return sprintf('%s / %s', $this->length, $this->unit);
    }
}