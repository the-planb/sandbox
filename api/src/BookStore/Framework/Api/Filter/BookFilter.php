<?php

namespace App\BookStore\Framework\Api\Filter;

use ApiPlatform\Api\FilterInterface;
use Symfony\Component\PropertyInfo\Type;

final class BookFilter implements FilterInterface
{
    public function getDescription(string $resourceClass): array
    {
        dump(
            'No dejamos que esto vaya a doctrine, lo pillamos antes (por eso no hereda de \ApiPlatform\Doctrine\Orm\Filter\AbstractFilter)',
            'y lo tratamos como lo que es, parte del patrón Criteria / Specification'
        );

        exit(__METHOD__);

        return [
            'title[equal]' => [
                'property' => 'title',
                'type' => Type::BUILTIN_TYPE_ARRAY,
                'required' => false,
            ],
        ];
    }
}
