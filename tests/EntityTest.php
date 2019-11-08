<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testEquals_TwoIdentitiesAreTheSame_ReturnTrue(): void
    {
        $entityA = new MyEntity('123');
        $entityB = new MyEntity('123');

        $this->assertTrue($entityA->equals($entityB));
    }

    public function testEquals_TwoIdentitiesAreDifferent_ReturnFalse(): void
    {
        $entityA = new MyEntity('123');
        $entityB = new MyEntity('124');

        $this->assertFalse($entityA->equals($entityB));
    }
}

class MyEntity extends Entity
{
    private $myId;

    public function __construct(string $myId)
    {
        $this->myId = $myId;
        parent::__construct();
    }

    public function getIdentity(): string
    {
        return $this->myId;
    }
}
