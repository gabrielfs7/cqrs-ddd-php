<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

class ProductId
{
    /** @var string */
    private $id;

    public function __construct(string $id = null)
    {
        $this->id = $id ?? uniqid();
    }

    public function value(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
