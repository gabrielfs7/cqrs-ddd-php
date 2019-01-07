<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Projection\UserBirthdayListProjection;
use Sample\Domain\Query\UserBirthdayListQuery;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;
use Sample\Domain\Query\UserBirthdayListQueryResponse;

class UserBirthdayListQueryHandler implements QueryHandlerInterface
{
    /** @var UserBirthdayListProjection */
    private $birthdaysProjection;

    public function __construct(UserBirthdayListProjection $birthdaysProjection)
    {
        $this->birthdaysProjection = $birthdaysProjection;
    }

    /**
     * @param QueryInterface|UserBirthdayListQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        return new UserBirthdayListQueryResponse($this->birthdaysProjection->list());
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof UserBirthdayListQuery;
    }
}
