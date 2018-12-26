<?php declare(strict_types = 1);

namespace Sample\Query;

use LogicException;

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
