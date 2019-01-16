<?php

namespace Sample\Application\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\CreateOrderCommand;
use Slim\Http\StatusCode;

class CreateOrderAction extends AbstractAction
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $payload = $this->parseJsonRequest($request);

        $this->commandBus->dispatch(
            new CreateOrderCommand(
                $payload['userId'],
                $payload['amount'],
                $payload['productSku']
            )
        );

        return $this->jsonResponse($response, StatusCode::HTTP_ACCEPTED);
    }

    protected function getPayloadDefault(): array
    {
        return [
            'userId' => null,
            'productSku' => null,
            'amount' => null,
        ];
    }
}