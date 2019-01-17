<?php

namespace Sample\Application\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\UpdateUserCommand;
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
        string $userId
    ): ResponseInterface {
        $payload = $this->parseJsonRequest($request);

        $this->commandBus->dispatch(
            new UpdateUserCommand(
                $userId,
                $payload['fullName'],
                $payload['username'],
                $payload['birthday']
            )
        );

        return $this->jsonResponse($response, StatusCode::HTTP_ACCEPTED);
    }

    protected function getPayloadDefault(): array
    {
        return [
            'fullName' => null,
            'username' => null,
            'birthday' => null,
        ];
    }
}