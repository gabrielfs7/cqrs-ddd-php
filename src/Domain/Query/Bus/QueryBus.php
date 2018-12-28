<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Bus;

use LogicException;
use Sample\Domain\Query\Handler\UserBirthdaysQueryHandler;
use Sample\Domain\Query\Handler\QueryHandlerInterface;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;

final class QueryBus implements QueryBusInterface
{
    /** @var QueryHandlerInterface[] */
    private $queryHandlers = [];

    public function __construct(UserBirthdaysQueryHandler $userBirthdaysQueryHandler)
    {
        $this->queryHandlers = [
            $userBirthdaysQueryHandler
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
