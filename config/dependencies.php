<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Container\ContainerInterface;
use Sample\Domain\Projection\OrderListProjection;
use Sample\Domain\Projection\UserBirthdayListProjection;
use Sample\Domain\Projection\UserListProjection;
use Sample\Infrastructure\Event\Bus\EventBus;
use Sample\Infrastructure\Event\Store\EventStoreClient;
use Sample\Infrastructure\Event\Store\EventStoreSetUp;

return [
    EntityManager::class => function (ContainerInterface $container): EntityManager {
        $settings = $container->get('settings')['doctrine'];

        $driver = new SimplifiedYamlDriver($settings['prefixes'], '.yml');

        $config = Setup::createConfiguration($settings['dev_mode']);
        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($settings['connection'], $config);
    },

    EntityManagerInterface::class => function (ContainerInterface $container): EntityManagerInterface {
        return $container->get(EntityManager::class);
    },

    EventBus::class => function (ContainerInterface $container): EventBus {
        return new EventBus(
            $container->get('settings')['eventstore']['stream'],
            $container->get(EventStoreClient::class)
        );
    },

    EventStoreSetUp::class => function (ContainerInterface $container): EventStoreSetUp {
        return new EventStoreSetUp(
            $container->get('eventstore-projections'),
            $container->get(EventStoreClient::class)
        );
    },

    UserBirthdayListProjection::class => function (ContainerInterface $container): UserBirthdayListProjection {
        return new UserBirthdayListProjection(
            $container->get(EventStoreClient::class),
            $container->get('settings')['eventstore']['stream']
        );
    },

    OrderListProjection::class => function (ContainerInterface $container): OrderListProjection {
        return new OrderListProjection(
            $container->get(EventStoreClient::class),
            $container->get('settings')['eventstore']['stream']
        );
    },

    UserListProjection::class => function (ContainerInterface $container): UserListProjection {
        return new UserListProjection(
            $container->get(EventStoreClient::class),
            $container->get('settings')['eventstore']['stream']
        );
    },

    EventStoreClient::class => function (ContainerInterface $container): EventStoreClient {
        $settings = $container->get('settings')['eventstore'];

        $options = [
            'base_uri' => $settings['url'],
            'curl' => [
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode($settings['username'] . ':' . $settings['password'])
                ],
            ],
        ];

        return new EventStoreClient($options);
    },

    AMQPStreamConnection::class => function (ContainerInterface $container): AMQPStreamConnection {
        $settings = $container->get('settings')['rabbitmq'];

        return new AMQPStreamConnection(
            $settings['host'],
            $settings['port'],
            $settings['user'],
            $settings['password']
        );
    },

    DateTimeInterface::class => function (): DateTimeInterface {
        return new DateTimeImmutable();
    },
];
