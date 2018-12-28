<?php declare(strict_types=1);

namespace Sample\Domain\Query;

interface QueryResponseInterface
{
    public function body(): array;
}
