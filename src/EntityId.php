<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use DateTime;
use InvalidArgumentException;

abstract class EntityId extends ValueObject
{
    protected $seqNo;
    protected $occuredDate;

    abstract public function getAbbr(): string;

    public function __construct(int $seqNo, DateTime $occuredDate)
    {
        if ($seqNo < 0) {
            throw new InvalidArgumentException('SeqNo can not be negative digital');
        }

        $this->seqNo = $seqNo;
        $this->occuredDate = $occuredDate;
    }

    public function toString(): string
    {
        return "{$this->getAbbr()}-{$this->occuredDate->format('Ymd')}-{$this->seqNo}";
    }

    public function getEqualityComponents(): array
    {
        return [
            $this->seqNo,
            $this->occuredDate->format('YmdHis'),
            $this->getAbbr(),
        ];
    }
}