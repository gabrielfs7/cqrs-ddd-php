<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;
use Sample\Infrastructure\Event\Bus\EventBus;

return [
    EntityManager::class => function (ContainerInterface $container): EntityManager {
        $settings = $container->get('settings')['doctrine'];

        $driver = new SimplifiedYamlDriver($settings['prefixes']);

        $config = Setup::createConfiguration($settings['dev_mode']);
        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($settings['connection'], $config);
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

    DateTimeInterface::class => function (): DateTimeInterface {
        return new DateTimeImmutable();
    }
];
