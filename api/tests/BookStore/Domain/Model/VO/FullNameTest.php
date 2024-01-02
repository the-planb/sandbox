<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\FullName;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class FullNameTest extends TestCase
{
    use BookStoreTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $firstName = $this->string();
        $lastName = $this->string();

        $sut = new FullName(...[
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);

        $this->assertSame($sut->getFirstName(), $firstName);
        $this->assertSame($sut->getLastName(), $lastName);
    }
}
