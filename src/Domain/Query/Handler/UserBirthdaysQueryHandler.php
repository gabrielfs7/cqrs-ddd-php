<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Query\UserBirthdaysQuery;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;
use Sample\Domain\Query\UserBirthdaysQueryResponse;

class UserBirthdaysQueryHandler implements QueryHandlerInterface
{
    /**
     * @param QueryInterface|UserBirthdaysQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        return new UserBirthdaysQueryResponse();
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof UserBirthdaysQuery;
    }
}
