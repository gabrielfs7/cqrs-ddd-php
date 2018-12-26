<?php declare(strict_types=1);

namespace Sample\Event\Publisher;

use Sample\Event\EventInterface;

interface EventPublisherInterface
{
    public function publish(EventInterface ...$domainEvents): void;
}
