<?php

namespace PlanB\Domain\Criteria;

final class Criteria
{
    private FilterList $filters;

    public function __construct(FilterList $filters)
    {
        $this->filters = $filters;
    }

    public static function fromValues(array $values): self
    {

        $page = 1;
        $itemsPerPage = 10;
        $filters = [];
        $order = null;

        foreach ($values as $name => $value) {
            match ($name) {
                'page' => null,
                'itemsPerPage' => null,
                'order' => null,
                default => $filters[] = self::filterFromValue($name, $value)
            };
        }

        return new self(FilterList::collect($filters));
    }

    private static function filterFromValue(string $field, array $filter): Filter
    {
        $operator = array_key_first($filter);
        $value = $filter[$operator];

        return new Filter($field, Operator::from($operator), $value);
    }

    public function getFilters(): FilterList
    {
        return $this->filters;
    }


}
