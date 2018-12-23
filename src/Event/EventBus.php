<?php declare(strict_types=1);

namespace Sample\Event;

class EventBus implements EventBusInterface
{
    public function notify(EventInterface $domainEvent): void
    {
        // TODO: Implement notify() method.
    }
}
