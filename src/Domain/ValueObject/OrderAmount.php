<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

class OrderAmount
{
    /** @var float */
    private $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function value(): float
    {
        return $this->amount;
    }

    public function __toString(): string
    {
        return (string)$this->amount;
    }
}
