<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\User;
use Sample\Domain\Event\Publisher\UserEventPublisher;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\Username;
use Sample\Domain\ValueObject\UserPassword;

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
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username,
        UserPassword $password
    ): void {
        $user = User::create($fullName, $birthday, $username, $password);

        $this->userRepository->save($user);

        $this->userDomainEventPublisher->publish(...$user->pullDomainEvents());
    }
}
