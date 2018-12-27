<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use Sample\Domain\Event\AbstractEvent;

class AbstractAggregateRoot implements AggregateRootInterface
{
    /** @var array */
    private $domainEvents;

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(AbstractEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
