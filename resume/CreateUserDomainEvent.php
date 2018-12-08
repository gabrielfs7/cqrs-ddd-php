<?php declare(strict_types=1);

class CreateUserDomainEvent extends AbstractDomainEvent
{
    public static function name(): string
    {
        return 'create-user';
    }
}
