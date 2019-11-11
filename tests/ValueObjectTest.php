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

    public function testEquals_PropertyIsValueObjectAndIsTheSame_ReturnTrue(): void
    {
        $person1 = new TestPerson('Eric', 34);
        $person2 = new TestPerson('Joanne', 18);

        $group1 = new TestGroup([$person1, $person2]);
        $group2 = new TestGroup([$person1, $person2]);

        $this->assertTrue($group1->equals($group2));
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    public function getEqualityComponents(): array
    {
        return [
            $this->name,
            $this->age,
        ];
    }
}

class TestGroup extends ValueObject
{
    /**
     * @var TestPerson[]
     */
    private $persons;

    public function __construct(array $person)
    {
        $this->persons = $person;
    }

    /**
     * Flat your value object implementation into an array, then you can use equals method to compare two value objects
     *  Example:
     *     // abstract public function getEqualityComponents(): array { return [$this->name, $this->amount];}
     *
     *  $orderItem1 = new OrderItem('item_name', 100);
     *  $orderItem2 = new OrderItem('item_name', 100);
     *
     *  $orderItem1->equals($orderItem2); // return true
     *
     * @return array
     */
    public function getEqualityComponents(): array
    {
        $components = [];

        foreach ($this->persons as $person) {
            $components[] = $person->getName();
            $components[] = $person->getAge();
        }

        return $components;
    }
}