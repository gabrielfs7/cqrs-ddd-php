<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use DateTimeInterface;

abstract class AbstractSaveUserCommand implements CommandInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $userId;

    /** @var string */
    protected $username;

    /** @var DateTimeInterface */
    protected $birthday;

    /** @var string */
    protected $fullName;

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
}
