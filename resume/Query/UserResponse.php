<?php declare(strict_types=1);

namespace Sample\Query;

use Sample\Entity\User;

final class UserResponse implements QueueResponseInterface
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
