<?php declare(strict_types = 1);

namespace Sample\Query;

interface QueryBusInterface
{
    public function registerHandler(QueryHandlerInterface $queryHandler): void;

    public function ask(QueryInterface $query): QueryResponseInterface;
}
