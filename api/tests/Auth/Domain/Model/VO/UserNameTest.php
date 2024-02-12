<?php

declare(strict_types=1);

namespace App\Tests\Auth\Domain\Model\VO;

use App\Auth\Domain\Model\VO\UserName;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class UserNameTest extends TestCase
{
    use AuthTrait;
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
