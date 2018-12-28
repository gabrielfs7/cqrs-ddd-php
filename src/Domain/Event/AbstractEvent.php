<?php declare(strict_types=1);

namespace Sample\Domain\Event;

use DateTimeImmutable;
use DateTimeInterface;

abstract class AbstractEvent implements EventInterface
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
        $this->eventId = $eventId ?? $this->generateId();
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

    private function generateId(): string
    {
        return 'a' . rand(1000000, 9999999) . '-' .
            'b' . rand(100, 999) . '-' .
            'c' . rand(100, 999) . '-' .
            'd' . rand(100, 999) . '-' .
            'e' . rand(10000000000, 99999999999);
    }
}
