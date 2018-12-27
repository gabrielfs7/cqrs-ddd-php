<?php declare(strict_types=1);

namespace Sample\Domain\Repository;

use Sample\Domain\Entity\User;
use Sample\Domain\ValueObject\UserId;

class UserRepository
{
    /** @var User[] */
    private static $localStorage = [];

    public function save(User $user): User
    {
        self::$localStorage[$user->id()->value()] = $user;

        return $user;
    }

    public function find(UserId $userId): ?User
    {
        return self::$localStorage[$userId->value()] ?? null;
    }
}
