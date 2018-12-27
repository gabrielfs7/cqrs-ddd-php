<?php declare(strict_types=1);

namespace Sample\Domain\Event;

interface EventSubscriberInterface
{
    public function subscribedTo(): array;
}
