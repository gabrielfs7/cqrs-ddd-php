<?php declare(strict_types=1);

namespace Sample\Domain\Event;

class OrderCreatedEvent extends AbstractEvent
{
    public function name(): string
    {
        return 'OrderCreated';
    }
}
