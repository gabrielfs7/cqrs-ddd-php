<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Sample\Domain\Event\OrderCreatedEvent;
use Sample\Domain\Event\OrderUpdatedEvent;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;

class Order extends AbstractAggregateRoot
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_CANCELED = 'canceled';

    /** @var string */
    private $id;

    /** @var User */
    private $user;

    /** @var float */
    private $amount;

    /** @var Product */
    private $product;

    /** @var string */
    private $status;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user();
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function changeStatus(OrderStatus $orderStatus): self
    {
        $this->status = $orderStatus->value();

        return $this;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function create(
        OrderId $id,
        User $user,
        Product $product,
        OrderAmount $amount,
        OrderStatus $orderStatus
    ): Order {
        $order = new self($id);
        $order->id = $id;
        $order->user = $user;
        $order->product = $product;
        $order->amount = $amount->value();
        $order->status = $orderStatus->value();
        $order->record(
            new OrderCreatedEvent(
                $id->value(),
                [
                    'id' => $id->value(),
                    'userId' => $user->id(),
                    'userFullName' => $user->fullName(),
                    'productName' => $product->name(),
                    'productSku' => $product->sku(),
                    'amount' => $amount->value(),
                    'status' => $orderStatus->value(),
                    'createdAt' => $order->createAt()->format(DATE_ATOM),
                ]
            )
        );

        return $order;
    }

    public static function update(Order $order, OrderStatus $orderStatus): Order
    {
        $order->changeStatus($orderStatus);
        $order->record(
            new OrderUpdatedEvent(
                (string)$order->id(),
                [
                    'id' => (string)$order->id(),
                    'orderStatus' => (string)$orderStatus,
                ]
            )
        );

        return $order;
    }
}
