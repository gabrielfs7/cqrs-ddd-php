<?php declare(strict_types=1);

namespace Sample\Domain\Repository;

use Sample\Domain\Entity\Order;
use Sample\Domain\ValueObject\OrderId;

class OrderRepository
{
    /** @var Order[] */
    private static $localStorage = [];

    public function save(Order $order): Order
    {
        self::$localStorage[$order->id()->value()] = $order;

        return $order;
    }

    public function find(OrderId $orderId): ?Order
    {
        return self::$localStorage[$orderId->value()] ?? null;
    }
}
