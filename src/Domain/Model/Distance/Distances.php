<?php

declare(strict_types = 1);

namespace App\Domain\Model\Distance;

final class Distances implements \IteratorAggregate, \Countable
{
    private array $distances;

    public static function fromArray(array $data): Distances
    {
        $distances = new self();

        foreach ($data as $item) {
            $distances->addDistance(Distance::fromStd($item));
        }

        return $distances;
    }

    public function addDistance(Distance $distance): void
    {
        $this->distances[] = $distance;
    }

    /**
     * By default this method returns total distance in meters
     */
    public function meters(): Distance
    {
        $result = Distance::fromMeters();

        /** @var Distance $distance */
        foreach ($this->distances as $distance) {
            $result = $result->sum($distance->toMeters());
        }

        return $result;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->distances);
    }

    public function count(): int
    {
        return count($this->distances);
    }
}