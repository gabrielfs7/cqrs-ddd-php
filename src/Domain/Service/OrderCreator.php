<?php declare(strict_types=1);

namespace Sample\Domain\Service;

use Sample\Domain\Entity\Order;
use Sample\Domain\Entity\Product;
use Sample\Domain\Entity\User;
use Sample\Domain\Event\Publisher\OrderEventPublisher;
use Sample\Domain\Repository\OrderRepository;
use Sample\Domain\Repository\ProductRepository;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\OrderAmount;
use Sample\Domain\ValueObject\OrderId;
use Sample\Domain\ValueObject\OrderStatus;
use Sample\Domain\ValueObject\ProductSku;
use Sample\Domain\ValueObject\UserId;

class OrderCreator
{
    /** @var OrderRepository */
    private $orderRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var ProductRepository */
    private $productRepository;

    /** @var OrderEventPublisher */
    private $orderEventPublisher;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderEventPublisher $userDomainEventPublisher
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderEventPublisher = $userDomainEventPublisher;
    }

    public function create(
        OrderId $id,
        UserId $userId,
        ProductSku $productSku,
        OrderAmount $amount
    ): void {
        /** @var User $user */
        $user = $this->userRepository->find($userId->value());

        /** @var Product $product */
        $product = $this->productRepository->findOneBy(['sku' => $productSku->value()]);

        $order = Order::create($id, $user, $product, $amount, OrderStatus::pending());

        $this->orderRepository->save($order);

        $this->orderEventPublisher->publish(...$order->pullDomainEvents());
    }
}
