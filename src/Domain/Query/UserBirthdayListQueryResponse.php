<?php declare(strict_types=1);

namespace Sample\Domain\Query;

final class UserBirthdayListQueryResponse implements QueryResponseInterface
{
    /** @var string */
    private $results;

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    public function body(): array
    {
        return $this->results;
    }
}
