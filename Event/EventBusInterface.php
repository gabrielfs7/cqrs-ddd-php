<?php declare(strict_types=1);

namespace Sample\Event;

interface EventBusInterface
{
    public function notify(EventInterface $domainEvent): void;
}
