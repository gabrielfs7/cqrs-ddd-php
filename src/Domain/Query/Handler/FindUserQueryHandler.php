<?php declare(strict_types = 1);

namespace Sample\Domain\Query\Handler;

use Sample\Domain\Query\FindUserQuery;
use Sample\Domain\Query\QueryInterface;
use Sample\Domain\Query\QueryResponseInterface;
use Sample\Domain\Query\UserQueryResponse;
use Sample\Domain\Repository\UserRepository;
use Sample\Domain\ValueObject\UserId;

class FindUserQueryHandler implements QueryHandlerInterface
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param QueryInterface|FindUserQuery $query
     */
    public function __invoke(QueryInterface $query): QueryResponseInterface
    {
        $user = $this->userRepository->find(new UserId($query->id()));

        return new UserQueryResponse(...[$user]);
    }

    public function canHandle(QueryInterface $query): bool
    {
        return $query instanceof FindUserQuery;
    }
}
