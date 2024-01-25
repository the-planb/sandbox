<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Framework\Doctrine\DBAL\PriceDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class PriceDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new PriceDBALType();
        $this->assertEquals(Price::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new PriceDBALType();
        $this->assertEquals('BookStore.Price', $type->getName());
    }
}
