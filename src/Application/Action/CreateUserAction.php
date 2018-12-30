<?php

namespace Sample\Application\Action;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\CreateUserCommand;
use Slim\Http\StatusCode;

class CreateUserAction extends AbstractAction
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(ContainerInterface $container)
    {
        $this->commandBus = $container->get(CommandBus::class);
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $payload = $this->parseJsonRequest($request);

        $this->commandBus->dispatch(
            new CreateUserCommand(
                $payload['fullName'],
                $payload['username'],
                $payload['password'],
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
            'password' => null,
            'birthday' => null,
        ];
    }
}