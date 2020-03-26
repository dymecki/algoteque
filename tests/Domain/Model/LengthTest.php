<?php

declare(strict_types = 1);

namespace Tests\Domain\Model;

use App\Domain\Model\Distance\Length;
use PHPUnit\Framework\TestCase;

final class LengthTest extends TestCase
{
    public function test_length_cannot_be_negative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Length(-2.8);
    }

    public function test_value_must_be_rounded_to_two_decimals(): void
    {
        $this->assertEquals(2.8, (new \App\Domain\Model\Distance\Length(2.8))->value());
        $this->assertEquals(2.47, (new \App\Domain\Model\Distance\Length(2.468))->value());
        $this->assertEquals(2.46, (new Length(2.455))->value());
        $this->assertEquals(2.45, (new \App\Domain\Model\Distance\Length(2.452))->value());
    }

    public function test_sum(): void
    {
        $lengthA = new Length(2.7);
        $lengthB = new Length(1.5);

        $this->assertEquals(4.2, $lengthA->sum($lengthB)->value());
    }

    public function test_to_string(): void
    {
        $this->assertEquals('2.7', (string) new \App\Domain\Model\Distance\Length(2.7));
    }
}
