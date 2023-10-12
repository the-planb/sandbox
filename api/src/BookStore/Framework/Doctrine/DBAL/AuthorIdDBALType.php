<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\AuthorId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class AuthorIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): AuthorId
    {
        return new AuthorId($value);
    }

    public function getName(): string
    {
        return 'BookStore.AuthorId';
    }
}
