<?php declare(strict_types=1);

namespace Sample\Domain\Event;

class UpdateUserEvent extends AbstractEvent
{
    public function name(): string
    {
        return 'UserUpdated';
    }
}
