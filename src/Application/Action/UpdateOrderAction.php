<?php

namespace Sample\Application\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\UpdateOrderCommand;
use Slim\Http\StatusCode;

class UpdateOrderAction extends AbstractAction
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        string $orderId
    ): ResponseInterface {
        $payload = $this->parseJsonRequest($request);

        $this->commandBus->dispatch(
            new UpdateOrderCommand(
                $orderId,
                $payload['status']
            )
        );

        return $this->jsonResponse($response, StatusCode::HTTP_ACCEPTED);
    }

    protected function getPayloadDefault(): array
    {
        return [
            'status' => null,
        ];
    }
}
