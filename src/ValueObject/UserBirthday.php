<?php declare(strict_types=1);

namespace Sample\ValueObject;

use DateTimeInterface;

class UserBirthday
{
    /** @var DateTimeInterface */
    private $birthday;

    public function __construct(DateTimeInterface $birthday)
    {
        $this->birthday = $birthday;
    }

    public function value(): DateTimeInterface
    {
        return $this->birthday;
    }

    public function __toString(): string
    {
        return $this->value()->format(DATE_ATOM);
    }
}
