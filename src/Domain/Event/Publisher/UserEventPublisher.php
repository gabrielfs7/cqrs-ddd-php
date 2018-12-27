<?php declare(strict_types=1);

namespace Sample\Domain\Event\Publisher;

use Sample\Domain\Event\Bus\EventBus;
use Sample\Domain\Event\Bus\EventBusInterface;
use Sample\Domain\Event\EventInterface;

class UserEventPublisher implements EventPublisherInterface
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
