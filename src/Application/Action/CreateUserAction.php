<?php

namespace Sample\Application\Action;

use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Sample\Domain\Command\Bus\CommandBus;
use Sample\Domain\Command\CreateUserCommand;

class CreateUserAction
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(ResponseInterface $response)
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

        return $response->withStatus(202);
    }
}