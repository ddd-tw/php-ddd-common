<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EntityIdTest extends TestCase
{
    public function testConstruct_WhenSeqNoLessThanZero_ThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new MyEntityId(-1, new DateTime());
    }

    public function testToString_MustReturnFormatSeqOccuredDateAbbr(): void
    {
        $sut = new MyEntityId(0, new DateTime('2019-01-01 13:14:15'));

        $r = $sut->toString();

        $this->assertEquals('test-20190101-0', $r);
    }
}

class MyEntityId extends EntityId
{
    public function getAbbr(): string
    {
        return 'test';
    }
}