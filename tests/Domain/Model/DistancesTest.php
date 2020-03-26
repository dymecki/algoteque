<?php

declare(strict_types = 1);

namespace Tests\Domain\Model;

use App\Domain\Model\Distance\Distance;
use App\Domain\Model\Distance\Distances;
use PHPUnit\Framework\TestCase;

final class DistancesTest extends TestCase
{
    public function test_sum_of_two_distances_with_different_units(): void
    {
        $distances = new Distances();
        $distances->addDistance(Distance::fromYards(3));
        $distances->addDistance(Distance::fromMeters(5));

        $this->assertEquals(7.74, $distances->meters()->length()->value());
//        $this->assertEquals(7.74, $distances->totalMeters()->length()->value());
    }

    public function test_add_distances_to_the_collection(): void
    {
        $distances = new Distances();
        $distances->addDistance(Distance::fromYards(3));
        $distances->addDistance(Distance::fromMeters(5));

        $this->assertCount(2, $distances);
    }
}
