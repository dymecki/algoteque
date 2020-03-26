<?php

declare(strict_types = 1);

namespace Tests\Domain\Model;

use App\Domain\Model\Distance\Distance;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class DistanceTest extends TestCase
{
    public function test_sum_two_distances_with_same_units(): void
    {
        $distance = Distance::fromMeters(3)->sum(Distance::fromMeters(5));

        $this->assertEquals(8, $distance->length()->value());
        $this->assertEquals('Meters', $distance->unit()->name());
        $this->assertEquals(8.75, $distance->toYards()->length()->value());
    }

    public function test_sum_two_distances_with_different_units(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Distance::fromMeters(3)->sum(Distance::fromYards(5));
    }

    public function test_conversion_from_yards_to_meters(): void
    {
        $distance = Distance::fromYards(3)->toMeters();

        $this->assertEquals(2.74, $distance->length()->value());
        $this->assertEquals('Meters', $distance->unit()->name());
    }

    public function test_conversion_from_meters_to_meters_should_give_the_same_object(): void
    {
        $distance = Distance::fromMeters(3);

        $this->assertSame($distance, $distance->toMeters());
    }

    public function test_conversion_from_yards_to_yards_should_give_the_same_object(): void
    {
        $distance = Distance::fromYards(3);

        $this->assertSame($distance, $distance->toYards());
    }

    public function test_conversion_from_meters_to_yards(): void
    {
        $distance = Distance::fromMeters(3)->toYards();

        $this->assertEquals(3.28, $distance->length()->value());
        $this->assertEquals('Yards', $distance->unit()->name());
    }

    public function test_conversion_from_meters_to_yards_2(): void
    {
        $yards = Distance::fromMeters(7.74)->toYards();

        $this->assertEquals(8.46, $yards->length()->value());
        $this->assertEquals('Yards', $yards->unit()->name());
    }

    public function test_conversion_from_meters_to_yards_back_and_forth(): void
    {
        $distance = Distance::fromMeters(3)->toYards()->toMeters();

        $this->assertEquals(3, $distance->length()->value());
        $this->assertEquals('Meters', $distance->unit()->name());
    }

    public function test_to_string(): void
    {
        $this->assertEquals('2.75 / Meters', (string) Distance::fromMeters(2.75));
    }
}
