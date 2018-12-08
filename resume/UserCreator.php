<?php declare(strict_types=1);

class UserCreator
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserDomainEventPublisher */
    private $userDomainEventPublisher;

    public function __construct(
        UserRepository $userRepository,
        UserDomainEventPublisher $userDomainEventPublisher
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
