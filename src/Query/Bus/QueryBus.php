<?php declare(strict_types = 1);

namespace Sample\Query\Bus;

use LogicException;
use Sample\Query\Handler\FindUserQueryHandler;
use Sample\Query\Handler\QueryHandlerInterface;
use Sample\Query\QueryInterface;
use Sample\Query\QueryResponseInterface;

final class QueryBus implements QueryBusInterface
{
    /** @var QueryHandlerInterface[] */
    private $queryHandlers = [];

    public function __construct(FindUserQueryHandler $findUserQueryHandler)
    {
        $this->queryHandlers = [
            $findUserQueryHandler
        ];
    }

    public function ask(QueryInterface $query): QueryResponseInterface
    {
        foreach ($this->queryHandlers as $handler) {
            if ($handler->canHandle($query)) {
                return $handler($query);
            }
        }

        throw new LogicException(sprintf('No QueryHandler registered for %', get_class($query)));
    }
}
