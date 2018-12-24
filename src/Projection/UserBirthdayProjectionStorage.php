<?php declare(strict_types = 1);

namespace Sample\Projection;

use Sample\ValueObject\UserId;

class UserBirthdayProjectionStorage
{
    /** @var array */
    private static $localStorage = [];

    public function store(UserId $userId, array $data): void
    {
        self::$localStorage[$userId->value()] = $data;
    }
}
