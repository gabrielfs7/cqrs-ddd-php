<?php declare(strict_types = 1);

namespace Sample\Query;

final class QueryBus
{
    public function ask(QueryInterface $query): QueryResponseInterface
    {
        //@TODO Implement...
        return new UserQueryResponse(null);
    }
}
