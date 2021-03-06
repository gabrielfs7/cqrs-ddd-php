<?php declare(strict_types=1);

namespace Sample\Domain\Entity;

use DateTime;
use DateTimeInterface;
use Sample\Domain\Event\UserUpdatedEvent;
use Sample\Domain\Event\UserCreatedEvent;
use Sample\Domain\ValueObject\UserBirthday;
use Sample\Domain\ValueObject\UserFullName;
use Sample\Domain\ValueObject\UserId;
use Sample\Domain\ValueObject\Username;
use Sample\Domain\ValueObject\UserPassword;

class User extends AbstractAggregateRoot
{
    /** @var string */
    private $id;

    /** @var string */
    private $fullName;

    /** @var DateTimeInterface */
    private $birthday;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function birthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function update(
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username
    ): self {
        $this->fullName = $fullName->value();
        $this->birthday = $birthday->value();
        $this->username = $username->value();

        $this->record(
            new UserUpdatedEvent(
                $this->id(),
                [
                    'fullName' => $this->fullName,
                    'birthday' => $this->birthday,
                    'username' => $this->username,
                ]
            )
        );

        return $this;
    }

    public static function create(
        UserId $userId,
        UserFullName $fullName,
        UserBirthday $birthday,
        Username $username,
        UserPassword $password
    ): User {
        $user = new self();
        $user->id = $userId->value();
        $user->fullName = $fullName->value();
        $user->birthday = $birthday->value();
        $user->username = $username->value();
        $user->password = $password->value();
        $user->record(
            new UserCreatedEvent(
                $userId->value(),
                [
                    'id' => $userId->value(),
                    'fullName' => $fullName->value(),
                    'birthday' => $birthday->__toString(),
                    'username' => $username->value(),
                    'password' => $password->value(),
                ]
            )
        );

        return $user;
    }
}
