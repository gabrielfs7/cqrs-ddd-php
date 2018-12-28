<?php declare(strict_types=1);

namespace Sample\Domain\Query;


final class UserBirthdaysQueryResponse implements QueryResponseInterface
{
    private $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function body(): array
    {
        return $this->users;
    }
}
