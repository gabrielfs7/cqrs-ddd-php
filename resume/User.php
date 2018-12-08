<?php declare(strict_types=1);

class User extends AbstractAggregateRoot
{
    /** @var UserId */
    private $id;

    /** @var Username */
    private $username;

    private function __construct(UserId $id, Username $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function username(): Username
    {
        return $this->username;
    }

    public static function create(UserId $id, Username $username): User
    {
        $user = new self($id, $username);
        $user->record(
            new CreateUserDomainEvent(
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
