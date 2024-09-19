<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\Filter;

use App\Media\Framework\Doctrine\Filter\FullNameFilter;
use Doctrine\ORM\Query\Expr;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Filter;
use PlanB\Domain\Criteria\Operator;
use PlanB\Framework\Doctrine\Criteria\InvalidFilterException;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class FullNameFilterTest extends TestCase
{
    use DoublesTrait;

    /**
     * @dataProvider filterProvider
     */
    public function test_it_filters_properly(string $field, Operator $operator, mixed $value, string $expected)
    {
        if (is_subclass_of($expected, \Exception::class)) {
            $this->expectException($expected);
        }

        $expr = new Expr();
        $filter = new FullNameFilter();
        $response = $filter->apply($expr, new Filter($field, $operator, $value));

        $this->assertEquals($expected, $response);
    }

    public function filterProvider(): array
    {
        return [
            ['field', Operator::EQUALS, 'value', InvalidFilterException::class],
            ['field', Operator::CONTAINS, 'value', InvalidFilterException::class],
            ['field', Operator::NOT_EQUALS, 'value', InvalidFilterException::class],
            ['field', Operator::STARTS_WITH, 'value', InvalidFilterException::class],
            ['field', Operator::ENDS_WITH, 'value', InvalidFilterException::class],
            ['field', Operator::GREATER_THAN, 'value', InvalidFilterException::class],
            ['field', Operator::LESS_THAN, 'value', InvalidFilterException::class],
            ['field', Operator::GREATER_OR_EQUALS_THAN, 'value', InvalidFilterException::class],
            ['field', Operator::LESS_OR_EQUALS_THAN, 'value', InvalidFilterException::class],
            ['field', Operator::BETWEEN, 'value', InvalidFilterException::class],
            ['field', Operator::IDENTITY, 'value', InvalidFilterException::class],
        ];
    }
}
