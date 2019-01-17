<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\Order;
use Sample\Domain\Event\Publisher\OrderEventPublisher;
use Sample\Domain\Repository\OrderRepository;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;

class OrderUpdater
{
    /** @var OrderRepository */
    private $orderRepository;

    /** @var OrderEventPublisher */
    private $orderEventPublisher;

    public function __construct(
        OrderRepository $orderRepository,
        OrderEventPublisher $orderEventPublisher
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderEventPublisher = $orderEventPublisher;
    }

    public function update(OrderId $orderId, OrderStatus $orderStatus): void
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($orderId->value());
        $order->update($order, $orderStatus);

        $this->orderRepository->save($order);

        $this->orderEventPublisher->publish(...$order->pullDomainEvents());
    }
}
