<?php declare(strict_types=1);

namespace Sample\Event;

use DateTimeImmutable;
use DateTimeInterface;

abstract class AbstractDomainEvent implements DomainEventInterface
{
    /** @var string */
    private $eventId;

    /** @var array */
    private $data;

    /** @var string */
    private $aggregateRootId;

    /** @var DateTimeInterface */
    private $occurredAt;

    public function __construct(
        string $aggregateRootId,
        array $data,
        string $eventId = null,
        DateTimeInterface $occurredAt = null
    ) {
        $this->data = $data;
        $this->aggregateRootId = $aggregateRootId;
        $this->eventId = $eventId ?? static::name()  . '_' . uniqid();
        $this->occurredAt = $occurredAt ?: new DateTimeImmutable();
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function aggregateRootId(): string
    {
        return $this->aggregateRootId;
    }

    public function occurredAt(): DateTimeInterface
    {
        return $this->occurredAt;
    }
}
