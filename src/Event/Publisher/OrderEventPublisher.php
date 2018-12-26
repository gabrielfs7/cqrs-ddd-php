<?php declare(strict_types=1);

namespace Sample\Event\Publisher;

use Sample\Event\Bus\EventBus;
use Sample\Event\Bus\EventBusInterface;
use Sample\Event\EventInterface;

class OrderEventPublisher implements EventPublisherInterface
{
    /** @var EventBusInterface */
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function publish(EventInterface ...$domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->eventBus->notify($domainEvent);
        }
    }
}
