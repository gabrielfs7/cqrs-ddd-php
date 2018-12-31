<?php declare(strict_types=1);

namespace Sample\Infrastructure\Event\Store;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Output\OutputInterface;

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

    public function setup(OutputInterface $output): void
    {
        foreach ($this->eventStoreProjections as $projectionName => $projectionOptions) {
            $projection = file_get_contents($projectionOptions['file']['path']);

            foreach ($projectionOptions['file']['parameters'] as $parameterName => $parameterValue) {
                $projection = str_replace($parameterName, $parameterValue, $projection);
            }

            $options = [
                RequestOptions::TIMEOUT => 30,
                RequestOptions::CONNECT_TIMEOUT => 30,
                'curl' => [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/x-www-form-urlencoded",
                        'Authorization: Basic ' . base64_encode('admin:changeit')
                    ],
                ],
                RequestOptions::FORM_PARAMS => [$projection]
            ];

            $uri = sprintf('/projections/%s', $projectionOptions['mode']);
            $uri .= '?' . http_build_query(
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

            try {
                $response = $this->client->post($uri, $options);

                $output->writeln(
                    'Response: ('
                    . $response->getStatusCode()
                    . ') '
                    . $response->getBody()->getContents()
                );
            } catch (Exception $exception) {
                $output->writeln('[ERROR] ' . $exception->getMessage());
            }
        }
    }
}
