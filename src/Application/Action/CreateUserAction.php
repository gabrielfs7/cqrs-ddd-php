<?php

namespace Sample\Application\Action;

use DateTime;
use Psr\Container\ContainerInterface;
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

    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        $this->commandBus->dispatch(
            new CreateUserCommand(
                'Julie West',
                'julie.west',
                'secret',
                new DateTime('1999-05-06')
            )
        );

        return $this->jsonResponse($response, StatusCode::HTTP_ACCEPTED);
    }
}