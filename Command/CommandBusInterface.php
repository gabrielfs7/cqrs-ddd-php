<?php declare(strict_types=1);

namespace Sample\Command;

interface CommandBusInterface
{
    public function registerHandler(CommandHandlerInterface $commandHandler): void;

    public function dispatch(CommandInterface $command): void;
}
