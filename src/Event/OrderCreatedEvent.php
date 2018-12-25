<?php declare(strict_types=1);

namespace Sample\Event;

class OrderCreatedEvent extends AbstractEvent
{
    public static function name(): string
    {
        return 'order-created';
    }
}
