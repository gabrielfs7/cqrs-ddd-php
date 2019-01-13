<?php declare(strict_types=1);

namespace Sample\Domain\Command;

use DateTime;

final class UpdateUserCommand extends AbstractSaveUserCommand
{
    public function __construct(
        string $userId,
        string $fullName,
        string $username,
        string $birthday
    ) {
        $this->userId = $userId;
        $this->username = $username;
        $this->birthday = new DateTime($birthday);
        $this->fullName = $fullName;

        $this->id = sprintf('update-user-%s', $this->userId);
    }
}
