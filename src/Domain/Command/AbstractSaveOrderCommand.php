<?php declare(strict_types=1);

namespace Sample\Domain\Command;

abstract class AbstractSaveOrderCommand implements CommandInterface
{
    /** @var string */
    protected $orderId;

    public function orderId(): string
    {
        return $this->orderId;
    }
}
