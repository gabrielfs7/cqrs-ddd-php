<?php declare(strict_types=1);

namespace Sample\Domain\Command\Bus;

use Sample\Domain\Command\CommandInterface;

interface CommandBusInterface
{
    public const QUEUE_NAME = 'commands-queue';

    public function dispatch(CommandInterface $command): void;
}
