<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use DateTime;
use DateTimeInterface;
use Sample\Domain\ValueObject\ProductId;
use Sample\Domain\ValueObject\ProductName;
use Sample\Domain\ValueObject\ProductSku;

final class Product extends AbstractAggregateRoot
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $sku;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sku(): string
    {
        return $this->sku;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function update(
        ProductName $name,
        ProductSku $sku
    ): self {
        $this->name = $name->value();
        $this->sku = $sku->value();

        //@TODO Register event

        return $this;
    }

    public static function create(
        ProductId $productId,
        ProductSku $productSku,
        ProductName $productName
    ): Product {
        $product = new self();
        $product->id = $productId->value();
        $product->sku = $productSku->value();
        $product->name = $productName->value();

        //@TODO Register event

        return $product;
    }
}
