<?php declare(strict_types=1);

namespace Sample\Service;

use Sample\Entity\User;
use Sample\Event\Publisher\UserEventPublisher;
use Sample\Repository\UserRepository;
use Sample\ValueObject\UserBirthday;
use Sample\ValueObject\UserFullName;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;
use Sample\ValueObject\UserPassword;

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

    public function create(
        UserId $id,
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username,
        UserPassword $password
    ): void {
        $user = User::create($id, $fullName, $birthday, $username, $password);

        $this->userRepository->save($user);

        $this->userDomainEventPublisher->publish(...$user->pullDomainEvents());
    }
}
