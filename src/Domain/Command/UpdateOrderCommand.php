<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;

final class UpdateOrderCommand implements CommandInterface
{
    /** @var string */
    private $orderId;

    /** @var string */
    private $orderStatus;

    public function __construct(OrderId $orderId, OrderStatus $orderStatus)
    {
        $this->orderId = $orderId->value();
        $this->orderStatus = $orderStatus->value();
    }

    public function orderId(): string
    {
        return $this->orderId;
    }

    public function orderStatus(): string
    {
        return $this->orderStatus;
    }

    public function id(): string
    {
        return sprintf('update-order-%s', $this->orderId);
    }
}
