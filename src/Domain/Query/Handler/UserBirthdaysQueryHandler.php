<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Projection\UserBirthdaysProjection;
use Sample\Domain\Query\UserBirthdaysQuery;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;
use Sample\Domain\Query\UserBirthdaysQueryResponse;

class UserBirthdaysQueryHandler implements QueryHandlerInterface
{
    /** @var UserBirthdaysProjection */
    private $birthdaysProjection;

    public function __construct(UserBirthdaysProjection $birthdaysProjection)
    {
        $this->birthdaysProjection = $birthdaysProjection;
    }

    /**
     * @param QueryInterface|UserBirthdaysQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        return new UserBirthdaysQueryResponse($this->birthdaysProjection->list());
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof UserBirthdaysQuery;
    }
}
