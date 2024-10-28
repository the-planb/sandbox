<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Filter;

use Doctrine\ORM\Query\Expr;
use PlanB\Domain\Criteria\Operator;
use PlanB\Framework\Doctrine\Criteria\CustomFilter;
use PlanB\Framework\Doctrine\Criteria\InvalidFilterException;

final class FullNameFilter extends CustomFilter
{
	protected function eq(Expr $expr, string $field, mixed $value): ?string
	{
		throw InvalidFilterException::make(Operator::EQUALS, $field);
		// return (string)$expr->orX(
		//     $this->iEq($expr, "$field.fieldA", "$value"),
		//     $this->iEq($expr, "$field.fieldB", "$value"),
		// );
	}

	protected function contains(Expr $expr, string $field, mixed $value): ?string
	{
		throw InvalidFilterException::make(Operator::CONTAINS, $field);
		// return (string)$expr->orX(
		//     $this->iLike($expr, "$field.fieldA", "%$value%"),
		//     $this->iLike($expr, "$field.fieldB", "%$value%"),
		// );
	}

	protected function neq(Expr $expr, string $field, mixed $value): ?string
	{
		throw InvalidFilterException::make(Operator::NOT_EQUALS, $field);
		// return (string)$expr->andX(
		//     $expr->not($this->iEq($expr, "$field.fieldA", $value)),
		//     $expr->not($this->iEq($expr, "$field.fieldB", $value)),
		// );
	}

	protected function startsWith(Expr $expr, string $field, mixed $value): ?string
	{
		throw InvalidFilterException::make(Operator::STARTS_WITH, $field);
		// return (string)$expr->orX(
		//     $this->iLike($expr, "$field.fieldA", "$value%"),
		//     $this->iLike($expr, "$field.fieldB", "$value%"),
		// );
	}

	protected function endsWith(Expr $expr, string $field, mixed $value): ?string
	{
		throw InvalidFilterException::make(Operator::ENDS_WITH, $field);
		// return (string)$expr->orX(
		//     $this->iLike($expr, "$field.fieldA", "%$value"),
		//     $this->iLike($expr, "$field.fieldB", "%$value"),
		// );
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
