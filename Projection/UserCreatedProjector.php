<?php declare(strict_types = 1);

namespace Sample\Projection;

use Sample\Event\CreateUserEvent;
use Sample\Repository\UserRepository;
use Sample\ValueObject\UserId;

class UserCreatedProjector
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserProjectionStorage */
    private $userProjectionStorage;

    public function __construct(UserRepository $userRepository, UserProjectionStorage $userProjectionStorage)
    {
        $this->userRepository = $userRepository;
        $this->userProjectionStorage = $userProjectionStorage;
    }

    public function notify(CreateUserEvent $event): void
    {
        $userId = new UserId($event->aggregateRootId());

        $user = $this->userRepository->find($userId);

        $this->userProjectionStorage->store(
            $userId,
            [
                'createdAt' => $user->createAt()
            ]
        );
    }
}
