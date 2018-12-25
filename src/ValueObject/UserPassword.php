<?php declare(strict_types=1);

namespace Sample\ValueObject;

class UserPassword
{
    /** @var string */
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function value(): string
    {
        return $this->password;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
