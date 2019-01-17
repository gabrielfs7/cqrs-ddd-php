<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Sample\Domain\Command\CommandInterface;
use Sample\Domain\Command\UpdateOrderCommand;
use Sample\Domain\Service\OrderUpdater;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;

final class UpdateOrderCommandHandler implements CommandHandlerInterface
{
    /** @var OrderUpdater */
    private $orderUpdater;

    public function __construct(OrderUpdater $orderUpdater)
    {
        $this->orderUpdater = $orderUpdater;
    }

    public function __invoke(CommandInterface $command): void
    {
        $this->orderUpdater->update(
            new OrderId($command->orderId()),
            new OrderStatus($command->orderStatus())
        );
    }

    public function canHandle(CommandInterface $command): bool
    {
        return $command instanceof UpdateOrderCommand;
    }
}
