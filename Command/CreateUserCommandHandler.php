<?php declare(strict_types=1);

namespace Sample\Command;

use Sample\Service\UserCreator;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;

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
            new Username($command->username())
        );
    }

    public function canHandle(CommandInterface $command): bool
    {
        return $command instanceof CreateUserCommand;
    }
}
