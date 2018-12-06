<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

use InvalidArgumentException;

final class EmailAddress
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    private function guard(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('The email <%s> is not valid'));
        }
    }

    public function value(): string
    {
        return $this->value;
    }


}
