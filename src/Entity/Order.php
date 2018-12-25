<?php declare(strict_types=1);

namespace Sample\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Sample\Event\OrderCreatedEvent;
use Sample\ValueObject\OrderAmount;
use Sample\ValueObject\OrderId;
use Sample\ValueObject\UserId;

final class Order extends AbstractAggregateRoot
{
    /** @var OrderId */
    private $id;

    /** @var UserId */
    private $userId;

    /** @var OrderAmount */
    private $amount;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId();
    }

    public function amount(): OrderAmount
    {
        return $this->amount;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function create(
        OrderId $id,
        UserId $userId,
        OrderAmount $amount
    ): Order {
        $order = new self($id);
        $order->id = $id;
        $order->userId = $userId;
        $order->amount = $amount;
        $order->record(
            new OrderCreatedEvent(
                $id->value(),
                [
                    'id' => $id->value(),
                    'userId' => $userId->value(),
                    'amount' => $amount->value(),
                ]
            )
        );

        return $order;
    }
}
