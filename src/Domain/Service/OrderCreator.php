<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\Order;
use Sample\Domain\Event\Publisher\OrderEventPublisher;
use Sample\Domain\Repository\OrderRepository;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\UserId;

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
