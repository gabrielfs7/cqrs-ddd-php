<?php declare(strict_types=1);

namespace Sample\Command\Bus;

use Sample\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
