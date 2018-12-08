<?php declare(strict_types=1);

namespace Sample\Repository;

use Sample\Entity\User;
use Sample\ValueObject\UserId;

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
