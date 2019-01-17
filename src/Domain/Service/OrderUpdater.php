<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\Order;
use Sample\Domain\Entity\User;
use Sample\Domain\Event\Publisher\OrderEventPublisher;
use Sample\Domain\Event\Publisher\UserEventPublisher;
use Sample\Domain\Repository\OrderRepository;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\UserId;
use Sample\Domain\ValueObject\Username;

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

    public function update(
        UserId $userId,
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username
    ): void {
        /** @var Order $order */
        $order = $this->orderRepository->find($userId->value());
        $order->update($fullName, $birthday, $username);

        $this->orderRepository->save($order);

        $this->orderEventPublisher->publish(...$order->pullDomainEvents());
    }
}
