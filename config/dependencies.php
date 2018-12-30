<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
use GuzzleHttp\Client;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Container\ContainerInterface;
use Sample\Infrastructure\Event\Bus\EventBus;

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
        $settings = $container->get('settings')['eventstore'];

        return new EventBus(
            $settings['host'],
            $settings['port'],
            $settings['stream'],
            $container->get(Client::class)
        );
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
