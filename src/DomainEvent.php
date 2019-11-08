<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use DateTime;
use Illuminate\Support\Str;

abstract class DomainEvent
{
    protected $eventId;
    protected $occuredDate;

    public function __construct(?DateTime $occuredDate = null)
    {
        $this->eventId = $this->generateEventId();
        $this->occuredDate = $occuredDate ?? new DateTime();
    }

    abstract public function generateEventId(): string;

    abstract public function getDerivedEventEqualityComponents(): array;

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getOccuredDate(): DateTime
    {
        return $this->occuredDate;
    }

    public function getEqualityComponents(): array
    {
        $components = [];
        $components[] = $this->eventId;
        $components[] = $this->occuredDate;
        $components[] = $this->getDerivedEventEqualityComponents();

        return $components;
    }
}