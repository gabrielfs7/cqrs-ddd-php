<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Bus;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Sample\Domain\Event\Bus\EventBusInterface;
use Sample\Domain\Event\EventInterface;

class EventBus implements EventBusInterface
{
    private const EVENT_STORE_URL = 'http://localhost:2113';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(EventInterface $event): void
    {
        $this->client->send(
            new Request(
                'POST',
                self::EVENT_STORE_URL . DIRECTORY_SEPARATOR . 'streams/cqrs_ddd_php',
                [
                    'Content-type' => 'application/json',
                    'ES-EventType' => $event->name(),
                    'ES-EventId' => $event->eventId()
                ],
                json_encode($event->data())
            )
        );
    }
}
