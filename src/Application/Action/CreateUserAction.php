<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
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
                uniqid(),
                '4',
                'Julie West',
                'julie.west',
                'secret',
                new DateTimeImmutable('1999-05-06')
            )
        );

        return $this->jsonResponse($response, StatusCode::HTTP_ACCEPTED);
    }
}