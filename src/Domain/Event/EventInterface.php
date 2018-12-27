<?php declare(strict_types=1);

namespace Sample\Domain\Event;

use DateTimeInterface;

interface EventInterface
{
    public static function name(): string;

    public function eventId(): string;

    public function data(): array;

    public function aggregateRootId(): string;

    public function occurredAt(): DateTimeInterface;
}
