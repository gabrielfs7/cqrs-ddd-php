<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Bus;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Sample\Domain\Event\Bus\EventBusInterface;
use Sample\Domain\Event\EventInterface;

class EventBus implements EventBusInterface
{
    /** @var Client */
    private $client;

    /** @var string */
    private $host;

    /** @var string */
    private $port;

    /** @var string */
    private $stream;

    public function __construct(
        string $host,
        string $port,
        string $stream,
        Client $client
    ) {
        $this->client = $client;
        $this->host = $host;
        $this->port = $port;
        $this->stream = $stream;
    }

    public function notify(EventInterface $event): void
    {
        $this->client->send(
            new Request(
                'POST',
                $this->host  . ':'. $this->port . '/streams/' . $this->stream,
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
