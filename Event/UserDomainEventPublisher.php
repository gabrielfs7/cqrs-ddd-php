<?php declare(strict_types=1);

namespace Sample\Event;

class UserDomainEventPublisher implements DomainEventPublisherInterface
{
    public function publish(DomainEventInterface ...$domainEvents): void
    {
        //@TODO Implement publish event...
    }
}
