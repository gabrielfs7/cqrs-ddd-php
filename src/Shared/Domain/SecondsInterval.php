<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

use LogicException;

final class SecondsInterval
{
    /** @var Second */
    private $from;

    /** @var Second */
    private $to;

    public function __construct(Second $from, Second $to)
    {
        $this->guard($from, $to);

        $this->from = $from;
        $this->to   = $to;
    }

    public function from(): Second
    {
        return $this->from;
    }

    public function to(): Second
    {
        return $this->to;
    }

    public static function fromValues(int $from, int $to): SecondsInterval
    {
        return new self(new Second($from), new Second($to));
    }

    private function guard(Second $from, Second $to)
    {
        if ($from->equalsTo($to) || $from->isBiggerThan($to)) {
            throw new LogicException(
                sprintf(
                    "Seconds from %s is equal or greater than %s",
                    $from->value(),
                    $to->value()
                )
            );
        }
    }
}
