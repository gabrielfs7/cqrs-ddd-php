<?php declare(strict_types=true);

class CreateUserDomainEvent extends AbstractDomainEvent
{
    public static function name(): string
    {
        return 'create-user';
    }
}
