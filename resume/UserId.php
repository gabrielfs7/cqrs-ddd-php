<?php declare(strict_types=true);

class UserId
{
    /** @var string */
    private $id;

    public function __construct(string $id = null)
    {
        $this->id = $id ?? uniqid();
    }

    public function value(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
