<?php declare(strict_types=1);

namespace Sample\Domain\Event\Bus;

use Sample\Domain\Event\EventInterface;

interface EventBusInterface
{
    public function notify(EventInterface $domainEvent): void;
}
