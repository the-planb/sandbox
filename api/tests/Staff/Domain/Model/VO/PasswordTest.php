<?php

declare(strict_types=1);

namespace App\Tests\Staff\Domain\Model\VO;

use App\Staff\Domain\Model\VO\Password;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class PasswordTest extends TestCase
{
    use StaffTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $password = $this->string();

        $sut = new Password(...[
            'password' => $password,
        ]);

        $this->assertSame($sut->getPassword(), $password);

        $this->assertSame((string) $sut, $password);
    }
}
