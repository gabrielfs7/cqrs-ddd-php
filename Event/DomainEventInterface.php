<?php declare(strict_types=1);

namespace Sample\Event;

use DateTimeInterface;

interface DomainEventInterface
{
    public static function name(): string;

    public function eventId(): string;

    public function data(): array;

    public function aggregateRootId(): string;

    public function occurredAt(): DateTimeInterface;
}
