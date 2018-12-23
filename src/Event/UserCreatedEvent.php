<?php declare(strict_types=1);

namespace Sample\Event;

class UserCreatedEvent extends AbstractEvent
{
    public static function name(): string
    {
        return 'user-created';
    }
}