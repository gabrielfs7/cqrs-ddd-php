<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

use Sample\Domain\Entity\Order;

class OrderStatus
{
    /** @var string */
    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public static function pending()
    {
        return new static(Order::STATUS_PENDING);
    }

    public static function approved()
    {
        return new static(Order::STATUS_APPROVED);
    }

    public static function canceled()
    {
        return new static(Order::STATUS_CANCELED);
    }

    public function value(): string
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return (string)$this->status;
    }
}
