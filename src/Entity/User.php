<?php declare(strict_types=1);

namespace Sample\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Sample\Event\UserCreatedEvent;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;

final class User extends AbstractAggregateRoot
{
    /** @var UserId */
    private $id;

    /** @var Username */
    private $username;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct(UserId $id, Username $username)
    {
        $this->id = $id;
        $this->username = $username;
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function username(): Username
    {
        return $this->username;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function create(UserId $id, Username $username): User
    {
        $user = new self($id, $username);
        $user->record(
            new UserCreatedEvent(
                $id->value(),
                [
                    'id' => $id->value(),
                    'username' => $username->value(),
                ]
            )
        );

        return $user;
    }
}
