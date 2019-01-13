<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

class ProductName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
