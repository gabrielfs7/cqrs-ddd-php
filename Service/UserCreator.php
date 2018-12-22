<?php declare(strict_types=1);

namespace Sample\Service;

use Sample\Entity\User;
use Sample\Event\UserEventPublisher;
use Sample\Repository\UserRepository;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;

class UserCreator
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserEventPublisher */
    private $userDomainEventPublisher;

    public function __construct(
        UserRepository $userRepository,
        UserEventPublisher $userDomainEventPublisher
    ) {
        $this->userRepository = $userRepository;
        $this->userDomainEventPublisher = $userDomainEventPublisher;
    }

    public function create(UserId $id, Username $username): void
    {
        $user = User::create($id, $username);

        $this->userRepository->save($user);

        $this->userDomainEventPublisher->publish(...$user->pullDomainEvents());
    }
}
