<?php declare(strict_types=1);

namespace Sample\Domain\Event\Publisher;

use Sample\Domain\Event\EventInterface;

interface EventPublisherInterface
{
    public function publish(EventInterface ...$domainEvents): void;
}
