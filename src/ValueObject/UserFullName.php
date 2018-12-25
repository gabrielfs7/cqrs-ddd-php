<?php declare(strict_types=1);

namespace Sample\ValueObject;

class UserFullName
{
    /** @var string */
    private $fullName;

    public function __construct(string $fullName)
    {
        $this->fullName = $fullName;
    }

    public function value(): string
    {
        return $this->fullName;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
