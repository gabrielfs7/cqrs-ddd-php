<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Bus;

use LogicException;
use Sample\Domain\Query\Handler\OrderListQueryHandler;
use Sample\Domain\Query\Handler\UserBirthdayListQueryHandler;
use Sample\Domain\Query\Handler\QueryHandlerInterface;
use Sample\Domain\Query\Handler\UserListQueryHandler;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;

final class QueryBus implements QueryBusInterface
{
    /** @var QueryHandlerInterface[] */
    private $queryHandlers = [];

    public function __construct(
        UserBirthdayListQueryHandler $userBirthdaysQueryHandler,
        UserListQueryHandler $userListQueryHandler,
        OrderListQueryHandler $orderListQueryHandler
    ) {
        $this->queryHandlers = [
            $userBirthdaysQueryHandler,
            $userListQueryHandler,
            $orderListQueryHandler
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
