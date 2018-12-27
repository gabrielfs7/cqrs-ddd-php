<?php declare(strict_types=1);

namespace Sample\Domain\Event\Bus;

use Sample\Domain\Event\EventInterface;

class EventBus implements EventBusInterface
{
    public function notify(EventInterface $domainEvent): void
    {
        // TODO: Implement notify() method.
    }
}
