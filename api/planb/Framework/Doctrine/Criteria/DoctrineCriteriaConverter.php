<?php

namespace PlanB\Framework\Doctrine\Criteria;

use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Collections\ExpressionBuilder;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Domain\Criteria\Filter;
use PlanB\Domain\Criteria\Operator;

final class DoctrineCriteriaConverter
{
    private ExpressionBuilder $expressionBuilder;
    private Criteria $criteria;

    final private function __construct(Criteria $criteria)
    {
        $this->expressionBuilder = DoctrineCriteria::expr();
        $this->criteria = $criteria;
    }

    public static function convert(Criteria $criteria): DoctrineCriteria
    {
        return (new self($criteria))->buildCriteria();

    }

    private function buildCriteria(): DoctrineCriteria
    {
        $expression = $this->getExpression();

        return new DoctrineCriteria($expression);
    }

    private function getExpression(): ?Expression
    {
        $filterList = $this->criteria->getFilters();

        if ($filterList->isEmpty()) {
            return null;
        }

        $expressions = $filterList->map(function (Filter $filter) {
            $field = $filter->getField();
            $operator = $filter->getOperator();
            $value = $filter->getValue();

            return match ($operator) {
                Operator::EQUALS => $this->expressionBuilder->eq($field, $value),
                Operator::NOT_EQUALS => $this->expressionBuilder->neq($field, $value),
                Operator::CONTAINS => $this->expressionBuilder->contains($field, $value),
                Operator::NOT_CONTAINS => $this->expressionBuilder->not($this->expressionBuilder->contains($field, $value)),
                Operator::STARTS => $this->expressionBuilder->startsWith($field, $value),
                Operator::ENDS => $this->expressionBuilder->endsWith($field, $value),
                Operator::GREATER_THAN => $this->expressionBuilder->gt($field, $value),
                Operator::LESS_THAN => $this->expressionBuilder->lt($field, $value),
                Operator::STRICTLY_GREATER_THAN => $this->expressionBuilder->gte($field, $value),
                Operator::STRICTLY_LESS_THAN => $this->expressionBuilder->lte($field, $value),
            };
        });

        return $this->expressionBuilder->andX(...$expressions);
    }
}
