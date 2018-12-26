<?php declare(strict_types=1);

namespace Sample\Command;

final class CommandBus implements CommandBusInterface
{
    /** @var CommandHandlerInterface[] */
    private $commandHandlers;

    public function __construct(
        CreateUserCommandHandler $createUserCommandHandler,
        CreateOrderCommandHandler $createOrderCommandHandler
    ) {
        $this->commandHandlers = [
            $createUserCommandHandler,
            $createOrderCommandHandler
        ];
    }

    public function dispatch(CommandInterface $command): void
    {
        foreach ($this->commandHandlers as $commandHandler) {
            if ($commandHandler->canHandle($command)) {
                $commandHandler($command);
            }
        }
    }
}
