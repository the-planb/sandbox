<?php

namespace PlanB\Domain\Criteria;

enum Operator: string
{
    case EQUALS = 'equals';
    case NOT_EQUALS = 'not_equals';
    case CONTAINS = 'contains';
    case NOT_CONTAINS = 'not_contains';
    case GREATER_THAN = 'gt';
    case LESS_THAN = 'lt';
    case STRICTLY_GREATER_THAN = 'gte';
    case STRICTLY_LESS_THAN = 'lte';
    case STARTS = 'starts';
    case ENDS = 'ends';
}


