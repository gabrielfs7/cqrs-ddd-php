<?php declare(strict_types=1);

namespace Sample\Event\Bus;

use Sample\Event\EventInterface;

class EventBus implements EventBusInterface
{
    public function notify(EventInterface $domainEvent): void
    {
        // TODO: Implement notify() method.
    }
}