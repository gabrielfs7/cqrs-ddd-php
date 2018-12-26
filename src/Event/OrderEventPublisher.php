<?php declare(strict_types=1);

namespace Sample\Event;

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
