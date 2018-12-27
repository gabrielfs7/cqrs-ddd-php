<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): QueryResponseInterface;

    public function canHandle(QueryInterface $query): bool;
}
