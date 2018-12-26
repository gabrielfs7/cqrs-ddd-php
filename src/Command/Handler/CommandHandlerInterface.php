<?php declare(strict_types=1);

namespace Sample\Command\Handler;

use Sample\Command\CommandInterface;

interface CommandHandlerInterface
{
    public function canHandle(CommandInterface $command): bool;

    public function __invoke(CommandInterface $command): void;
}
