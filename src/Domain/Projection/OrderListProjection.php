<?php declare(strict_types = 1);

namespace Sample\Domain\Projection;

use GuzzleHttp\RequestOptions;
use Sample\Infrastructure\Event\Store\EventStoreClient;

class OrderListProjection
{
    /** @var EventStoreClient */
    private $eventStoreClient;

    /** @var string */
    private $streamName;

    public function __construct(EventStoreClient $eventStoreClient, string $streamName)
    {
        $this->eventStoreClient = $eventStoreClient;
        $this->streamName = $streamName;
    }

    public function list(): array
    {
        $response = $this->eventStoreClient->get(
            '/projection/user-orders/state',
            [
                RequestOptions::QUERY => [
                    'partition' => $this->streamName
                ]
            ]
        );

        return json_decode($response->getBody()->getContents(), true) ?? [
                'total' => 0,
                'data' => []
            ];
    }
}
