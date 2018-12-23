<?php declare(strict_types=1);

namespace Sample\Event;

interface EventSubscriberInterface
{
    public function subscribedTo(): array;
}
