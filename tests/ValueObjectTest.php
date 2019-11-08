<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    public function testEquals_AllPropertiesAreTheSame_ReturnTrue(): void
    {
        $personA = new TestPerson('Eric', 32);
        $personB = new TestPerson('Eric', 32);

        $this->assertTrue($personA->equals($personB));
    }

    public function testEquals_PropertiesAreNotAllTheSame_ReturnFalse(): void
    {
        $personA = new TestPerson('Eric', 32);
        $personB = new TestPerson('Eric', 31);

        $this->assertFalse($personA->equals($personB));
    }
}

class TestPerson extends ValueObject
{
    private $name;
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getEqualityComponents(): array
    {
        return [
            $this->name,
            $this->age,
        ];
    }
}