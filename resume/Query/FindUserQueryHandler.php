<?php declare(strict_types = 1);

namespace Sample\Query;

use Sample\Repository\UserRepository;
use Sample\ValueObject\UserId;

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
}
