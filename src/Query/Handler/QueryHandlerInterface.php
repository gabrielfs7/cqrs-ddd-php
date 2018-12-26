<?php declare(strict_types = 1);

namespace Sample\Query\Handler;

use Sample\Query\QueryInterface;
use Sample\Query\QueryResponseInterface;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): QueryResponseInterface;

    public function canHandle(QueryInterface $query): bool;
}
