<?php declare(strict_types=1);

namespace Sample\Domain\Query;

use Sample\Domain\Entity\User;

final class UserQueryResponse implements QueryResponseInterface
{
    /** @var User[] */
    private $users;

    public function __construct(?User ...$users)
    {
        $this->users = $users;
    }

    public function users(): array
    {
        return $this->users;
    }

    public function user(): ?User
    {
        return current($this->users) ?? null;
    }
}
