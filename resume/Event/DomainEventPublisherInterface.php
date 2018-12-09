<?php declare(strict_types=1);

namespace Sample\Event;

interface DomainEventPublisherInterface
{
    public function publish(DomainEventInterface ...$domainEvents): void;
}
