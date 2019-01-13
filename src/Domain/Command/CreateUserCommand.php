<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use DateTime;
use Sample\Domain\ValueObject\UserId;

final class CreateUserCommand extends AbstractSaveUserCommand
{
    /** @var string */
    protected $password;

    public function __construct(
        string $fullName,
        string $username,
        string $birthday,
        string $password
    ) {
        $this->userId = (new UserId())->value();
        $this->username = $username;
        $this->birthday = new DateTime($birthday);
        $this->fullName = $fullName;
        $this->password = $password;

        $this->id = sprintf('create-user-%s', $this->userId);
    }

    public function password(): string
    {
        return $this->password;
    }
}
