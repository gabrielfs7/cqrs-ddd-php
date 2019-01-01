<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Store;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Exception;
use Psr\Http\Message\ResponseInterface;
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
            try {
                $this->deleteStream($projectionName);
                $this->deleteProjection($projectionName);

                $response = $this->createProjection($projectionName, $projectionOptions);

                $output->writeln(
                    sprintf(
                        'Response: (%s) %s',
                        $response->getStatusCode(),
                        $response->getBody()->getContents()
                    )
                );
            } catch (Exception $exception) {
                $output->writeln(sprintf('[ERROR] (%s) %s', $projectionName, $exception->getMessage()));
            }
        }
    }

    private function deleteProjection(string $projectionName): void
    {
        try {
            $options = [
                RequestOptions::QUERY => [
                    'deleteStateStream' => 'true',
                    'deleteCheckpointStream' => 'true',
                    'deleteEmittedStreams' => 'true',
                ]
            ];

            $this->client->delete(sprintf('/projections/%s', $projectionName), $options);
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }
        }
    }

    private function deleteStream(string $projectionName): void
    {
        try {
            $this->client->delete(sprintf('/streams/%s', $projectionName));
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }
        }
    }

    private function createProjection(string $projectionName, array $projectionOptions): ResponseInterface
    {
        $uri = sprintf('/projections/%s', $projectionOptions['mode']);

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
            RequestOptions::BODY => $this->parseProjection($projectionOptions)
        ];

        return $this->client->post($uri, $options);
    }

    private function parseProjection(array $projectionOptions): string
    {
        $projection = file_get_contents($projectionOptions['file']['path']);

        foreach ($projectionOptions['file']['parameters'] as $parameterName => $parameterValue) {
            $projection = str_replace($parameterName, $parameterValue, $projection);
        }

        return $projection;
    }
}
