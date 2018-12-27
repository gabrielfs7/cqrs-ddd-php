<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use Sample\Domain\Event\AbstractEvent;
use Sample\Domain\Event\EventInterface;

class AbstractAggregateRoot implements AggregateRootInterface
{
    /** @var EventInterface[] */
    private $events;

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->events;

        $this->events = [];

        return $domainEvents;
    }

    final protected function record(AbstractEvent $domainEvent): void
    {
        $this->events[] = $domainEvent;
    }
}
