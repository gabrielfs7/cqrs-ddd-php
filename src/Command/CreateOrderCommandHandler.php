<?php declare(strict_types=1);

namespace Sample\Command;

use Sample\Service\OrderCreator;
use Sample\ValueObject\UserBirthday;
use Sample\ValueObject\UserFullName;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;
use Sample\ValueObject\UserPassword;

final class CreateOrderCommandHandler implements CommandHandlerInterface
{
    /** @var OrderCreator */
    private $orderCreator;

    public function __construct(OrderCreator $orderCreator)
    {
        $this->orderCreator = $orderCreator;
    }

    public function __invoke(CommandInterface $command): void
    {
        $this->orderCreator->create(
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
