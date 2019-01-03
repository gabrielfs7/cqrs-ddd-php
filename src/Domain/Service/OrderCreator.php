<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\Order;
use Sample\Domain\Entity\User;
use Sample\Domain\Event\Publisher\OrderEventPublisher;
use Sample\Domain\Repository\OrderRepository;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\UserId;

class OrderCreator
{
    /** @var OrderRepository */
    private $orderRepository;

    /** @var OrderEventPublisher */
    private $orderEventPublisher;

    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderEventPublisher $userDomainEventPublisher
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderEventPublisher = $userDomainEventPublisher;
        $this->userRepository = $userRepository;
    }

    public function create(
        OrderId $id,
        UserId $userId,
        OrderAmount $amount
    ): void {
        /** @var User $user */
        $user = $this->userRepository->find($userId->value());

        $order = Order::create($id, $user, $amount);

        $this->orderRepository->save($order);

        $this->orderEventPublisher->publish(...$order->pullDomainEvents());
    }
}
