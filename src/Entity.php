<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

abstract class Entity
{
    /**
     * Returning a property as a entity identity in the implementing class because every entity must define an identity
     * Example:
     *  return $this->orderId;
     * You could use equals method to compare two entities after you implement this method
     * Example:
     *  $order = new Order();
     *  $anotherOrder = new Order();
     *  $order->equals($order);
     *
     * @return string
     */
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