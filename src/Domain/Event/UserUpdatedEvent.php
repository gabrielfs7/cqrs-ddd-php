<?php declare(strict_types=1);

namespace Sample\Domain\Event;

class UserUpdatedEvent extends AbstractEvent
{
    public function name(): string
    {
        return 'UserUpdated';
    }
}
