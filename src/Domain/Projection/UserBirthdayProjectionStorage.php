<?php declare(strict_types = 1);

namespace Sample\Domain\Projection;

use Sample\Domain\ValueObject\UserId;

class UserBirthdayProjectionStorage
{
    /** @var array */
    private static $localStorage = [];

    public function store(UserId $userId, array $data): void
    {
        self::$localStorage[$userId->value()] = $data;
    }
}
