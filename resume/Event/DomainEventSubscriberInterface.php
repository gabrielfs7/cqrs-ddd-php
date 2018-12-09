<?php declare(strict_types=1);

namespace Sample\Event;

interface DomainEventSubscriberInterface
{
    public function subscribedTo(): array;
}
