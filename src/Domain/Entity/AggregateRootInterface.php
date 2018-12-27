<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

interface AggregateRootInterface
{
    public function pullDomainEvents(): array;
}
