<?php declare(strict_types=1);

namespace Sample\Domain\Event;

class OrderUpdatedEvent extends AbstractEvent
{
    public function name(): string
    {
        return 'OrderUpdated';
    }
}
