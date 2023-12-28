<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Filter;

use Doctrine\ORM\Query\Expr;
use PlanB\Domain\Criteria\Operator;
use PlanB\Framework\Doctrine\Criteria\CustomFilter;
use PlanB\Framework\Doctrine\Criteria\InvalidFilterException;

final class FullNameFilter extends CustomFilter
{
    protected function eq(Expr $expr, string $field, mixed $value): ?string
    {
        return (string) $expr->orX(
            $this->iEq($expr, "{$field}.firstName", $value),
            $this->iEq($expr, "{$field}.lastName", $value),
        );
    }

    protected function neq(Expr $expr, string $field, mixed $value): ?string
    {
        return (string) $expr->not($this->eq($expr, $field, $value));
    }

    protected function contains(Expr $expr, string $field, mixed $value): ?string
    {
        return (string) $expr->orX(
            $this->iLike($expr, "{$field}.firstName", "%{$value}%"),
            $this->iLike($expr, "{$field}.lastName", "%{$value}%"),
        );
    }

    protected function startsWith(Expr $expr, string $field, mixed $value): ?string
    {
        return (string) $expr->orX(
            $this->iLike($expr, "{$field}.firstName", "{$value}%"),
            $this->iLike($expr, "{$field}.lastName", "{$value}%"),
        );
    }

    protected function endsWith(Expr $expr, string $field, mixed $value): ?string
    {
        return (string) $expr->orX(
            $this->iLike($expr, "{$field}.firstName", "%{$value}"),
            $this->iLike($expr, "{$field}.lastName", "%{$value}"),
        );
    }

    protected function gt(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::GREATER_THAN, $field);
    }

    protected function lt(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::LESS_THAN, $field);
    }

    protected function gte(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::GREATER_OR_EQUALS_THAN, $field);
    }

    protected function lte(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::LESS_OR_EQUALS_THAN, $field);
    }

    protected function between(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::BETWEEN, $field);
    }

    protected function identity(Expr $expr, string $field, mixed $value): ?string
    {
        throw InvalidFilterException::make(Operator::IDENTITY, $field);
    }
}
