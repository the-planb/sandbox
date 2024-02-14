<?php

declare(strict_types=1);

namespace App\Tests\Staff\Domain\Model\VO;

use App\Staff\Domain\Model\VO\UserName;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class UserNameTest extends TestCase
{
    use StaffTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->string();

        $sut = new UserName(...[
            'name' => $name,
        ]);

        $this->assertSame($sut->getName(), $name);

        $this->assertSame((string) $sut, $name);
    }
}
