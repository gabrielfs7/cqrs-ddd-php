<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Store;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EventStoreSetUp
{
    /** @var array */
    private $eventStoreProjections;

    /** @var EventStoreClient */
    private $client;

    public function __construct(array $eventStoreProjections, EventStoreClient $client)
    {
        $this->eventStoreProjections = $eventStoreProjections;
        $this->client = $client;
    }

    public function setUp(OutputInterface $output): void
    {
        $this->enableProjection(urlencode('$by_category'), $output);

        foreach ($this->eventStoreProjections as $projectionName => $projectionOptions) {
            try {
                $this->disableProjection($projectionName, $output);
                $this->abortProjection($projectionName, $output);
                $this->deleteProjection($projectionName, $output);
                $this->createProjection($projectionName, $projectionOptions, $output);
            } catch (Exception $exception) {
                $output->writeln(
                    sprintf(
                        '[ERROR] Projection "%s": %s',
                        $projectionName,
                        $exception->getMessage()
                    )
                );
            }
        }
    }

    private function deleteProjection(string $projectionName, OutputInterface $output): void
    {
        try {
            $options = [
                RequestOptions::QUERY => [
                    'deleteStateStream' => 'true',
                    'deleteCheckpointStream' => 'true',
                    'deleteEmittedStreams' => 'true',
                ],
                RequestOptions::BODY => http_build_query([
                    'deleteStateStream' => 'true',
                    'deleteCheckpointStream' => 'true',
                    'deleteEmittedStreams' => 'true',
                ])
            ];

            $response = $this->client->delete(sprintf('/projection/%s', $projectionName), $options);

            $output->writeln(
                sprintf(
                    '[OK] Projection "%s" removed: %s',
                    $projectionName,
                    $response->getBody()->getContents()
                )
            );
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }

            $output->writeln(
                sprintf(
                    '[WARNING] Projection "%s" not found',
                    $projectionName
                )
            );
        }
    }

    private function disableProjection(string $projectionName, OutputInterface $output): void
    {
        try {
            $options = [
                'curl' => $this->client->getConfig('curl') + [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                ],
                RequestOptions::BODY => 'enableRunAs=true'
            ];

            $response = $this->client->post(sprintf('/projection/%s/command/disable', $projectionName), $options);

            $output->writeln(
                sprintf(
                    '[OK] Projection "%s" disabled: %s',
                    $projectionName,
                    $response->getBody()->getContents()
                )
            );
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }

            $output->writeln(
                sprintf(
                    '[WARNING] Projection "%s" not found',
                    $projectionName
                )
            );
        }
    }

    private function enableProjection(string $projectionName, OutputInterface $output): void
    {
        try {
            $options = [
                'curl' => $this->client->getConfig('curl') + [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                ],
                RequestOptions::BODY => 'enableRunAs=true'
            ];

            $response = $this->client->post(sprintf('/projection/%s/command/enable', $projectionName), $options);

            $output->writeln(
                sprintf(
                    '[OK] Projection "%s" enabled: %s',
                    $projectionName,
                    $response->getBody()->getContents()
                )
            );
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }

            $output->writeln(
                sprintf(
                    '[WARNING] Projection "%s" not found',
                    $projectionName
                )
            );
        }
    }

    private function abortProjection(string $projectionName, OutputInterface $output): void
    {
        try {
            $options = [
                'curl' => $this->client->getConfig('curl') + [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                ],
                RequestOptions::BODY => 'enableRunAs=true'
            ];

            $response = $this->client->post(sprintf('/projection/%s/command/abort', $projectionName), $options);

            $output->writeln(
                sprintf(
                    '[OK] Projection "%s" aborted: %s',
                    $projectionName,
                    $response->getBody()->getContents()
                )
            );
        } catch (BadResponseException $exception) {
            if ($exception->getResponse()->getStatusCode() != 404) {
                throw $exception;
            }

            $output->writeln(
                sprintf(
                    '[WARNING] Projection "%s" not found',
                    $projectionName
                )
            );
        }
    }

    private function createProjection(
        string $projectionName,
        array $projectionOptions,
        OutputInterface $output
    ): ResponseInterface {
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
            RequestOptions::BODY => $this->parseProjection($projectionName, $projectionOptions)
        ];

        $response = $this->client->post($uri, $options);

        $output->writeln(
            sprintf(
                'Response: (%s) %s',
                $response->getStatusCode(),
                $response->getBody()->getContents()
            )
        );

        return $response;
    }

    private function parseProjection(string $projectionName, array $projectionOptions): string
    {
        $projection = file_get_contents($projectionOptions['file']['path'] . $projectionName . '.js');

        foreach ($projectionOptions['file']['parameters'] as $parameterName => $parameterValue) {
            $projection = str_replace($parameterName, $parameterValue, $projection);
        }

        return $projection;
    }
}
