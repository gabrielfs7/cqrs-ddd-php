<?php declare(strict_types=1);

namespace Sample\Event;

class CreateUserEvent extends AbstractEvent
{
    public static function name(): string
    {
        return 'create-user';
    }
}
