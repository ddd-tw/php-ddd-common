<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

class DomainEvents
{
    private $domainEvents = [];

    public function add(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}