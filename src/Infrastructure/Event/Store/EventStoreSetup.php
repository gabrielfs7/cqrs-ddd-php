<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Store;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class EventStoreSetup
{
    /** @var Client */
    private $client;

    /** @var array */
    private $eventStoreProjections;

    public function __construct(
        array $eventStoreProjections,
        Client $client
    ) {
        $this->eventStoreProjections = $eventStoreProjections;
        $this->client = $client;
    }

    public function setup(): void
    {
        // - Delete existent projections.

        foreach ($this->eventStoreProjections as $projectionName => $projectionOptions) {
            $projection = file_get_contents($projectionOptions['file']['path']);

            foreach ($projectionOptions['file']['parameters'] as $parameterName => $parameterValue) {
                $projection = str_replace($parameterName, $parameterValue, $projection);
            }

            $options = [
                RequestOptions::HEADERS => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic ' , base64_encode('root:root'),
                ],
                RequestOptions::TIMEOUT => 30,
                RequestOptions::CONNECT_TIMEOUT => 30,
                RequestOptions::BODY => $projection,
            ];

            $url = sprintf('projections/%s', $projectionOptions['mode']);
            $url .= '?' . http_build_query(
                [
                    'name' => $projectionName,
                    'type' => 'js',
                    'enabled' => 'true',
                    'emit' => 'true',
                    'trackemittedstreams' => 'true',
                ],
                '',
                '%26'
            );

            $response = $this->client->post($url, $options);

            echo PHP_EOL;
            echo PHP_EOL;
            echo 'Response: (' . $response->getStatusCode() . ') ' . $response->getBody()->getContents();
            echo PHP_EOL;
            echo PHP_EOL;
        }
    }
}
