<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\Filter;

use App\BookStore\Framework\Doctrine\Filter\FullNameFilter;
use Doctrine\ORM\Query\Expr;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Filter;
use PlanB\Domain\Criteria\Operator;
use PlanB\Framework\Doctrine\Criteria\InvalidFilterException;

/**
 * @internal
 */
class FullNameFilterTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test_filter(Operator $operator, string|InvalidFilterException $expected)
    {
        $this->markTestIncomplete('This test has not been implemented yet.');

        $expr = new Expr();
        $filter = new Filter('name', $operator, 'value');
        $fullNameFilter = new FullNameFilter();

        if ($expected instanceof InvalidFilterException) {
            $this->expectExceptionMessage($expected->getMessage());
            $fullNameFilter->apply($expr, $filter);

            return;
        }

        $this->assertEquals($expected, $fullNameFilter->apply($expr, $filter));
    }

    public function dataProvider()
    {
        return [
            [Operator::EQUALS, 'equals filter'],
            [Operator::NOT_EQUALS, 'not_equals filter'],
            [Operator::CONTAINS, 'contains filter'],
            [Operator::NOT_CONTAINS, 'not_contains filter'],
            [Operator::GREATER_THAN, 'gt filter'],
            [Operator::LESS_THAN, 'lt filter'],
            [Operator::GREATER_OR_EQUALS_THAN, 'gte filter'],
            [Operator::LESS_OR_EQUALS_THAN, 'lte filter'],
            [Operator::BETWEEN, 'between filter'],
            [Operator::STARTS_WITH, 'starts filter'],
            [Operator::ENDS_WITH, 'ends filter'],
            //            [Operator::IDENTITY, InvalidFilterException::make(Operator::IDENTITY, 'name')],
            //            [Operator::NOT_IDENTITY, InvalidFilterException::make(Operator::NOT_IDENTITY, 'name')],
        ];
    }
}
