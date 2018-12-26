<?php declare(strict_types=1);

namespace Sample\Command\Handler;

use Sample\Command\CommandInterface;
use Sample\Command\CreateUserCommand;
use Sample\Service\UserCreator;
use Sample\ValueObject\UserBirthday;
use Sample\ValueObject\UserFullName;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;
use Sample\ValueObject\UserPassword;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    /** @var UserCreator */
    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function __invoke(CommandInterface $command): void
    {
        $this->userCreator->create(
            new UserId($command->userId()),
            new UserFullName($command->fullName()),
            new UserBirthday($command->birthday()),
            new Username($command->username()),
            new UserPassword($command->password())
        );
    }

    public function canHandle(CommandInterface $command): bool
    {
        return $command instanceof CreateUserCommand;
    }
}
