<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static FilterOperator gt()
 * @method static FilterOperator lt()
 * @method static FilterOperator like()
 */
final class FilterOperator extends Enum
{
    const EQUAL    = '=';
    const GT       = '>';
    const LT       = '<';
    const CONTAINS = 'CONTAINS';

    public static function equal(): self
    {
        return new self('=');
    }

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException(sprintf('The filter <%s> is invalid', $value));
    }
}
