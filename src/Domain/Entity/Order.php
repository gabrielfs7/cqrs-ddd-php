<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Sample\Domain\Event\OrderCreatedEvent;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;
use Sample\Domain\ValueObject\UserId;

final class Order extends AbstractAggregateRoot
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_CANCELED = 'canceled';

    /** @var OrderId */
    private $id;

    /** @var User */
    private $user;

    /** @var OrderAmount */
    private $amount;

    /** @var Product */
    private $product;

    /** @var string */
    private $orderStatus;

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
        $order->amount = $amount;
        $order->orderStatus = $orderStatus->value();
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
                    'createdAt' => $order->createAt()->format(DATE_ATOM),
                ]
            )
        );

        return $order;
    }
}
