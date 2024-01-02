<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\Title;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class TitleTest extends TestCase
{
    use BookStoreTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $title = $this->string();

        $sut = new Title(...[
            'title' => $title,
        ]);

        $this->assertSame($sut->getTitle(), $title);

        $this->assertSame((string) $sut, $title);
    }
}
