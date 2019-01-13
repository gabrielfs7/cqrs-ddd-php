<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Sample\Domain\Command\CommandInterface;
use Sample\Domain\Command\UpdateUserCommand;
use Sample\Domain\Service\UserUpdater;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\UserId;
use Sample\Domain\ValueObject\Username;

final class UpdateUserCommandHandler implements CommandHandlerInterface
{
    /** @var UserUpdater */
    private $userUpdater;

    public function __construct(UserUpdater $userUpdater)
    {
        $this->userUpdater = $userUpdater;
    }

    public function __invoke(CommandInterface $command): void
    {
        $this->userUpdater->update(
            new UserId($command->userId()),
            new UserFullName($command->fullName()),
            new UserBirthday($command->birthday()),
            new Username($command->username())
        );
    }

    public function canHandle(CommandInterface $command): bool
    {
        return $command instanceof UpdateUserCommand;
    }
}
