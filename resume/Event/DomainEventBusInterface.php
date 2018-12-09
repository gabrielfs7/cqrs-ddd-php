<?php declare(strict_types=1);

namespace Sample\Event;

interface DomainEventBusInterface
{
    public function notify(DomainEventInterface $domainEvent): void;
}
