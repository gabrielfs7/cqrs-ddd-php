<?php declare(strict_types=1);

namespace Sample\Entity;

interface AggregateRootInterface
{
    public function pullDomainEvents(): array;
}
