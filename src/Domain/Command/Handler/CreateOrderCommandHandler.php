<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Sample\Domain\Command\CommandInterface;
use Sample\Domain\Command\CreateOrderCommand;
use Sample\Domain\Service\OrderCreator;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\UserId;

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
            new OrderId($command->orderId()),
            new UserId($command->userId()),
            new OrderAmount($command->amount())
        );
    }

    public function canHandle(CommandInterface $command): bool
    {
        return $command instanceof CreateOrderCommand;
    }
}
