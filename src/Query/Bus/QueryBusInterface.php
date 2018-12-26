<?php declare(strict_types = 1);

namespace Sample\Query\Bus;

use Sample\Query\QueryInterface;
use sample\query\queryresponseinterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): QueryResponseInterface;
}
