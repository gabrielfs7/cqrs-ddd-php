<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Bus;

use Sample\Domain\Query\QueryInterface;
use sample\Domain\Query\queryresponseinterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): QueryResponseInterface;
}
