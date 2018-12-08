<?php declare(strict_types=1);

namespace Sample\Event;

class UserDomainEventPublisher
{
    public function publish(AbstractDomainEvent ...$domainEvents): void
    {
        //@TODO Implement publish event...
    }
}
