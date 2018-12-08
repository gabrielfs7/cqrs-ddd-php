<?php declare(strict_types=1);

namespace Sample\Query;

use function Lambdish\Phunctional\first;
use Sample\Entity\User;

class UserResponse
{
    /**
     * @var User[]
     */
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
        return first($this->users) ?? null;
    }
}
