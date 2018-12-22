<?php declare(strict_types=1);

namespace Sample\Event;

interface EventPublisherInterface
{
    public function publish(EventInterface ...$domainEvents): void;
}
