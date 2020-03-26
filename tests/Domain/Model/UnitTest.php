<?php

declare(strict_types = 1);

namespace Tests\Domain\Model;

use App\Domain\Model\Distance\Unit;
use PHPUnit\Framework\TestCase;

final class UnitTest extends TestCase
{
    public function test_constructor_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Unit('Feets');
    }

    public function test_two_meter_unit_are_equal(): void
    {
        $this->assertTrue(Unit::meter()->equals(\App\Domain\Model\Distance\Unit::meter()));
    }

    public function test_two_yard_unit_are_equal(): void
    {
        $this->assertTrue(Unit::meter()->equals(Unit::meter()));
    }

    public function test_meter_is_meter(): void
    {
        $this->assertTrue(Unit::meter()->isMeter());
        $this->assertFalse(Unit::meter()->isYard());
    }

    public function test_yard_is_yard(): void
    {
        $this->assertTrue(Unit::yard()->isYard());
        $this->assertFalse(Unit::yard()->isMeter());
    }

    public function test_meter_name(): void
    {
        $this->assertEquals('Meters', Unit::meter()->name());
    }

    public function test_yard_name(): void
    {
        $this->assertEquals('Yards', Unit::yard()->name());
    }

    public function test_to_string(): void
    {
        $this->assertEquals('Yards', (string) Unit::yard());
    }
}
