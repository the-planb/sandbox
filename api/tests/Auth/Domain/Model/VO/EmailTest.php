<?php

declare(strict_types=1);

namespace App\Tests\Auth\Domain\Model\VO;

use App\Auth\Domain\Model\VO\Email;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class EmailTest extends TestCase
{
    use AuthTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $email = $this->string();

        $sut = new Email(...[
            'email' => $email,
        ]);

        $this->assertSame($sut->getEmail(), $email);

        $this->assertSame((string) $sut, $email);
    }
}
