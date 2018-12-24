<?php declare(strict_types = 1);

namespace Sample\Projection;

use Sample\Event\UserCreatedEvent;
use Sample\ValueObject\UserId;

class UserBirthdayProjector
{
    /** @var UserBirthdayProjectionStorage */
    private $userProjectionStorage;

    public function __construct(UserBirthdayProjectionStorage $userProjectionStorage)
    {
        $this->userProjectionStorage = $userProjectionStorage;
    }

    public function notify(UserCreatedEvent $event): void
    {
        $userId = new UserId($event->aggregateRootId());

        $this->userProjectionStorage->store(
            $userId,
            [
                'username' => $event->data()['username'],
                'birthday' => $event->data()['birthday']
            ]
        );
    }
}