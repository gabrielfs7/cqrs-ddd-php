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
        string $userId,
        string $orderId,
        string $amount
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->amount = $amount;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function orderId(): string
    {
        return $this->orderId;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
