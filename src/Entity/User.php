<?php declare(strict_types=1);

namespace Sample\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Sample\Event\UserCreatedEvent;
use Sample\ValueObject\UserBirthday;
use Sample\ValueObject\UserFullName;
use Sample\ValueObject\UserId;
use Sample\ValueObject\Username;
use Sample\ValueObject\UserPassword;

final class User extends AbstractAggregateRoot
{
    /** @var UserId */
    private $id;

    /** @var UserFullName */
    private $fullName;

    /** @var UserBirthday */
    private $birthday;

    /** @var Username */
    private $username;

    /** @var UserPassword */
    private $password;

    /** @var DateTimeInterface */
    private $createdAt;

    private function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function fullName(): UserFullName
    {
        return $this->fullName;
    }

    public function birthday(): UserBirthday
    {
        return $this->birthday;
    }

    public function username(): Username
    {
        return $this->username;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function createAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function create(
        UserId $id,
        Username $username,
        UserFullName $fullName,
        UserPassword $password,
        UserBirthday $birthday
    ): User {
        $user = new self($id, $username);
        $user->id = $id;
        $user->fullName = $fullName;
        $user->username = $username;
        $user->password = $password;
        $user->birthday = $birthday;
        $user->record(
            new UserCreatedEvent(
                $id->value(),
                [
                    'id' => $id->value(),
                    'fullName' => $fullName->value(),
                    'username' => $username->value(),
                    'password' => $password->value(),
                    'birthday' => $birthday->__toString(),
                ]
            )
        );

        return $user;
    }
}
