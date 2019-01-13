<?php declare(strict_types=1);

namespace Sample\Domain\ValueObject;

class ProductSku
{
    /** @var string */
    private $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;
    }

    public function value(): string
    {
        return $this->sku;
    }

    public function __toString(): string
    {
        return (string)$this->sku;
    }
}
