<?php declare(strict_types=true);

class AbstractAggregateRoot
{
    /** @var array */
    private $domainEvents;

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(AbstractDomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
