<?php declare(strict_types=1);

namespace Sample\Service;

use Sample\Entity\Order;
use Sample\Event\OrderEventPublisher;
use Sample\Repository\OrderRepository;
use Sample\ValueObject\OrderAmount;
use Sample\ValueObject\OrderId;
use Sample\ValueObject\UserId;

class OrderCreator
{
    /** @var OrderRepository */
    private $orderRepository;

    /** @var OrderEventPublisher */
    private $orderEventPublisher;

    public function __construct(
        OrderRepository $userRepository,
        OrderEventPublisher $userDomainEventPublisher
    ) {
        $this->orderRepository = $userRepository;
        $this->orderEventPublisher = $userDomainEventPublisher;
    }

    public function create(
        OrderId $id,
        UserId $userId,
        OrderAmount $amount
    ): void {
        $order = Order::create($id, $userId, $amount);

        $this->orderRepository->save($order);

        $this->orderEventPublisher->publish(...$order->pullDomainEvents());
    }
}
