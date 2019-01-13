<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

class OrderStatus
{
    /** @var string */
    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function value(): string
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return (string)$this->status;
    }
}
