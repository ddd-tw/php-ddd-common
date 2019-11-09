<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

abstract class DomainEvent
{
    protected $eventId;
    protected $occuredDate;

    /**
     * DomainEvent constructor.
     * @param DateTime|null $occuredDate
     * @throws Exception
     */
    public function __construct(?DateTime $occuredDate = null)
    {
        $this->eventId = Uuid::uuid4()->toString();
        $this->occuredDate = $occuredDate ?? new DateTime();
    }

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