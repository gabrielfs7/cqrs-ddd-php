<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use Sample\Domain\ValueObject\OrderId;

final class CreateOrderCommand extends AbstractSaveOrderCommand
{
    /** @var string */
    private $userId;

    /** @var float */
    private $amount;

    /** @var string */
    private $productSku;

    public function __construct(string $userId, float $amount, string $productSku)
    {
        $orderId = (new OrderId())->value();

        $this->id = sprintf('create-order-%s', $orderId);
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->productSku = $productSku;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function productSku(): string
    {
        return $this->productSku;
    }

    public function id(): string
    {
        return sprintf('create-order-%s', $this->orderId);
    }
}
