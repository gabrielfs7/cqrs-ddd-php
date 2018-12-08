<?php declare(strict_types=true);

abstract class AbstractDomainEvent
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
        $this->eventId = $eventId ?? self::name()  . '_' . uniqid();
        $this->occurredAt = $occurredAt ?: new DateTimeImmutable();
    }

    abstract public static function name(): string;

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