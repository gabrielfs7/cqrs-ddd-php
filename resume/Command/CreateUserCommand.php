<?php declare(strict_types=1);

namespace Sample\Command;

final class CreateUserCommand implements CommandInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $userId;

    /** @var string */
    private $username;

    public function __construct(string $id, string $userId, string $username)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->username = $username;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function username(): string
    {
        return $this->username;
    }
}
