<?php declare(strict_types=true);

class UserCreator
{
    public function create(UserId $id, Username $username): User
    {
        $user = User::create($id, $username);

        //@TODO call repository...
        //@TODO call event publisher...
    }
}
