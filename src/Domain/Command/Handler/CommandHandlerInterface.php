<?php declare(strict_types=1);

namespace Sample\Domain\Command\Handler;

use Sample\Domain\Command\CommandInterface;

interface CommandHandlerInterface
{
    public function canHandle(CommandInterface $command): bool;

    public function __invoke(CommandInterface $command): void;
}
