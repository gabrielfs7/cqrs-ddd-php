<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Bus;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Sample\Domain\Event\Bus\EventBusInterface;
use Sample\Domain\Event\EventInterface;

class EventBus implements EventBusInterface
{
    /** @var string */
    private $stream;

    /** @var Client */
    private $client;

    public function __construct(string $stream, Client $client)
    {
        $this->stream = $stream;
        $this->client = $client;
    }

    public function notify(EventInterface $event): void
    {
        $this->client->send(
            new Request(
                'POST',
                sprintf('/streams/%s', $this->stream),
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
