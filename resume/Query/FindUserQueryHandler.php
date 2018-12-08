<?php declare(strict_types = 1);

namespace Sample\Query;

use Sample\Repository\UserRepository;
use Sample\ValueObject\UserId;

class FindUserQueryHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(FindUserQuery $query): UserResponse
    {
        $user = $this->userRepository->find(new UserId($query->id()));

        return new UserResponse(...[$user]);
    }
}
