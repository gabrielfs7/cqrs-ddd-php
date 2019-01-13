<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use Sample\Domain\ValueObject\OrderId;

final class CreateOrderCommand implements CommandInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $userId;

    /** @var string */
    private $orderId;

    /** @var float */
    private $amount;

    /** @var string */
    private $sku;

    /** @var string */
    private $status;

    public function __construct(string $userId, float $amount, string $sku, string $status)
    {
        $orderId = (new OrderId())->value();

        $this->id = sprintf('create-order-%s', $orderId);
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->sku = $sku;
        $this->status = $status;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function orderId(): string
    {
        return $this->orderId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
