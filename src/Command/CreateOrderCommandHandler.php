<?php declare(strict_types=1);

namespace Sample\Command;

use Sample\Service\OrderCreator;
use Sample\ValueObject\OrderAmount;
use Sample\ValueObject\OrderId;
use Sample\ValueObject\UserId;

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
