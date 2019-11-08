<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

abstract class Entity
{
    abstract public function getIdentity(): string;

    private $eventSuppressed = false;

    private $domainEvents;

    public function __construct()
    {
        $this->domainEvents = new DomainEvents();
    }

    public function equals(?Entity $entity): bool
    {
        if ($entity === null) {
            return false;
        }

        return $this->getIdentity() === $entity->getIdentity();
    }

    public function suppressEvent(): void
    {
        $this->eventSuppressed = true;
    }

    public function unSuppressEvent(): void
    {
        $this->eventSuppressed = false;
    }

    protected function applyEvent(DomainEvent $domainEvent): void
    {
        if (!$this->eventSuppressed) {
            $this->domainEvents->add($domainEvent);
        }
    }
}