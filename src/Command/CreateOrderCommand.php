<?php declare(strict_types=1);

namespace Sample\Command;

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

    public function __construct(
        string $id,
        string $orderId,
        string $userId,
        string $amount
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->amount = $amount;
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
}
