<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\VO\Price;
use PlanB\Framework\Doctrine\DBAL\Type\IntegerType;

final class PriceDBALType extends IntegerType
{
    public function getFQN(): string
    {
        return Price::class;
    }

    public function getName(): string
    {
        return 'BookStore.Price';
    }
}
