<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Store;

use GuzzleHttp\RequestOptions;
use Exception;
use Symfony\Component\Console\Output\OutputInterface;

class EventStoreSetUp
{
    /** @var EventStoreClient */
    private $client;

    /** @var array */
    private $eventStoreProjections;

    public function __construct(
        array $eventStoreProjections,
        EventStoreClient $client
    ) {
        $this->eventStoreProjections = $eventStoreProjections;
        $this->client = $client;
    }

    public function setUp(OutputInterface $output): void
    {
        foreach ($this->eventStoreProjections as $projectionName => $projectionOptions) {
            $projection = file_get_contents($projectionOptions['file']['path']);

            foreach ($projectionOptions['file']['parameters'] as $parameterName => $parameterValue) {
                $projection = str_replace($parameterName, $parameterValue, $projection);
            }

            $options = [
                RequestOptions::QUERY => [
                    'name' => $projectionName,
                    'type' => 'js',
                    'enabled' => 'true',
                    'emit' => 'true',
                    'trackemittedstreams' => 'true',
                ],
                'curl' => $this->client->getConfig('curl') + [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                ],
                RequestOptions::BODY => $projection
            ];

            $uri = sprintf('/projections/%s', $projectionOptions['mode']);

            try {
                $response = $this->client->post($uri, $options);

                $output->writeln(
                    sprintf(
                        'Response: (%s) %s',
                        $response->getStatusCode(),
                        $response->getBody()->getContents()
                    )
                );
            } catch (Exception $exception) {
                $output->writeln('[ERROR] ' . $exception->getMessage());
            }
        }
    }
}
