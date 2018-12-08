<?php declare(strict_types=1);

namespace Sample\Event;

class CreateUserDomainEvent extends AbstractDomainEvent
{
    public static function name(): string
    {
        return 'create-user';
    }
}
