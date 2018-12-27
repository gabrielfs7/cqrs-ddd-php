<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Sample\Domain\Command\CommandInterface;
use Sample\Domain\Command\CreateUserCommand;
use Sample\Domain\Service\UserCreator;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\UserId;
use Sample\Domain\ValueObject\Username;
use Sample\Domain\ValueObject\UserPassword;

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
