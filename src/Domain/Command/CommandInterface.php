<?php declare(strict_types=1);

namespace Sample\Domain\Command;

interface CommandInterface
{
    public function id(): string;
}
