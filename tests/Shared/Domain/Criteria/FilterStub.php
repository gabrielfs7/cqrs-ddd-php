<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\Filter;
use CodelyTv\Shared\Domain\Criteria\FilterField;
use CodelyTv\Shared\Domain\Criteria\FilterOperator;
use CodelyTv\Shared\Domain\Criteria\FilterValue;

final class FilterStub
{
    public static function create(FilterField $field, FilterOperator $operator, FilterValue $value)
    {
        return new Filter($field, $operator, $value);
    }

    public static function fromValues($values)
    {
        return Filter::fromValues($values);
    }

    public static function random()
    {
        return self::create(FilterFieldStub::random(), FilterOperator::random(), FilterValueStub::random());
    }
}
