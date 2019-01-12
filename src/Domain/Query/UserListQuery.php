<?php declare(strict_types = 1);

namespace Sample\Domain\Query;

use DateTimeInterface;

class UserListQuery implements QueryInterface
{
    /** @var DateTimeInterface */
    private $referenceDay;

    public function __construct(DateTimeInterface $referenceDay)
    {
        $this->referenceDay = $referenceDay;
    }

    public function referenceDay(): DateTimeInterface
    {
        return $this->referenceDay;
    }
}
