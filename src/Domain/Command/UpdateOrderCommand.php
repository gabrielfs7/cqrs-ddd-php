<?php declare(strict_types=1);

namespace Sample\Domain\Command;

final class UpdateOrderCommand extends AbstractSaveOrderCommand
{
    /** @var string */
    private $orderStatus;

    public function __construct(string $orderId, string $orderStatus)
    {
        $this->orderId = $orderId;
        $this->orderStatus = $orderStatus;
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
