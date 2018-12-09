<?php declare(strict_types=1);

namespace Sample\Command;

use Sample\Service\UserCreator;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;

final class CreateUserCommandHandler
{
    /** @var UserCreator */
    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function __invoke(CreateUserCommand $createUserCommand): void
    {
        $this->userCreator->create(
            new UserId($createUserCommand->userId()),
            new Username($createUserCommand->username())
        );
    }
}
