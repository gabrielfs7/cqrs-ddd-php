<?php declare(strict_types=1);

namespace Sample\Domain\Event;

class UserCreatedEvent extends AbstractEvent
{
    public function name(): string
    {
        return 'user-created';
    }
}
