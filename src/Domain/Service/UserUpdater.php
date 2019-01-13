<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\User;
use Sample\Domain\Event\Publisher\UserEventPublisher;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\UserId;
use Sample\Domain\ValueObject\Username;

class UserUpdater
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

    public function update(
        UserId $userId,
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username
    ): void {
        /** @var User $user */
        $user = $this->userRepository->find($userId->value());
        $user->update($fullName, $birthday, $username);

        $this->userRepository->save($user);

        $this->userDomainEventPublisher->publish(...$user->pullDomainEvents());
    }
}
