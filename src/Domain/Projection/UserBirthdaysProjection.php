<?php declare(strict_types = 1);

namespace Sample\Domain\Projection;

use Sample\Infrastructure\Event\Store\EventStoreClient;

class UserBirthdaysProjection
{
    /** @var EventStoreClient */
    private $eventStoreClient;

    public function __construct(EventStoreClient $eventStoreClient)
    {
        $this->eventStoreClient = $eventStoreClient;
    }

    public function list(): array
    {
        $response = $this->eventStoreClient->get('/projection/user_birthdays_projection/result');

        return json_decode($response->getBody()->getContents(), true);
    }
}
