<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\TagName;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class TagNameTest extends TestCase
{
    use BookStoreTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->string();

        $sut = new TagName(...[
            'name' => $name,
        ]);

        $this->assertSame($sut->getName(), $name);

        $this->assertSame((string) $sut, $name);
    }
}
