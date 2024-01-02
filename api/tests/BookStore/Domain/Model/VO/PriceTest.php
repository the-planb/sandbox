<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\Price;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class PriceTest extends TestCase
{
    use BookStoreTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $amount = $this->int();

        $sut = new Price(...[
            'amount' => $amount,
        ]);

        $this->assertSame($sut->getAmount(), $amount);

        $this->assertSame($sut->toInt(), $amount);
    }
}
