<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use DateTimeInterface;

final class CreateUserCommand implements CommandInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $userId;

    /** @var string */
    private $username;

    /** @var DateTimeInterface */
    private $birthday;

    /** @var string */
    private $fullName;

    /** @var string */
    private $password;

    public function __construct(
        string $id,
        string $userId,
        string $fullName,
        string $username,
        string $password,
        DateTimeInterface $birthday
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->username = $username;
        $this->birthday = $birthday;
        $this->fullName = $fullName;
        $this->password = $password;
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

    public function birthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function password(): string
    {
        return $this->password;
    }
}
