<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Projection\UserListProjection;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;
use Sample\Domain\Query\UserListQuery;
use Sample\Domain\Query\UserListQueryResponse;

class UserListQueryHandler implements QueryHandlerInterface
{
    /** @var UserListProjection */
    private $userListProjection;

    public function __construct(UserListProjection $userListProjection)
    {
        $this->userListProjection = $userListProjection;
    }

    /**
     * @param QueryInterface|UserListQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        return new UserListQueryResponse($this->userListProjection->list());
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof UserListQuery;
    }
}
