<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Bus;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Sample\Domain\Event\Bus\EventBusInterface;
use Sample\Domain\Event\EventInterface;
use Sample\Infrastructure\Event\Store\EventStoreClient;

class EventBus implements EventBusInterface
{
    /** @var string */
    private $stream;

    /** @var Client */
    private $client;

    public function __construct(string $stream, EventStoreClient $client)
    {
        $this->stream = $stream;
        $this->client = $client;
    }

    public function notify(EventInterface $event): void
    {
        $curlOptions = $this->client->getConfig('curl');
        $curlOptions[CURLOPT_HTTPHEADER][] = 'ES-EventType: ' . $event->name();
        $curlOptions[CURLOPT_HTTPHEADER][] = 'ES-EventId: ' . $event->eventId();

        $this->client->post(
            sprintf('/streams/%s', $this->stream),
            [
                'curl' => $curlOptions,
                RequestOptions::BODY => json_encode($event->data())
            ]
        );
    }
}
