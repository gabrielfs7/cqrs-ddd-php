<?php declare(strict_types = 1);

namespace Sample\Query;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): QueryResponseInterface;

    public function canHandle(QueryInterface $query): bool;
}
