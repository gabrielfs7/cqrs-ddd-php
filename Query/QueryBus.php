<?php declare(strict_types = 1);

namespace Sample\Query;

use LogicException;

final class QueryBus implements QueryBusInterface
{
    /** @var QueryHandlerInterface[] */
    private $queryHandlers = [];

    public function registerHandler(QueryHandlerInterface $queryHandler): void
    {
        $this->queryHandlers[] = $queryHandler;
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
