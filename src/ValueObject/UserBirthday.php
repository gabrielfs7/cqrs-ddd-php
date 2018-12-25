<?php declare(strict_types=1);

namespace Sample\ValueObject;

use DateTimeImmutable;

class UserBirthday
{
    /** @var DateTimeImmutable */
    private $birthday;

    public function __construct(string $birthday)
    {
        $this->birthday = new DateTimeImmutable($birthday);
    }

    public function value(): DateTimeImmutable
    {
        return $this->birthday;
    }

    public function __toString(): string
    {
        return $this->value()->format(DATE_ATOM);
    }
}
