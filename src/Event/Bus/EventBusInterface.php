<?php declare(strict_types=1);

namespace Sample\Event\Bus;

use Sample\Event\EventInterface;

interface EventBusInterface
{
    public function notify(EventInterface $domainEvent): void;
}
