<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\MovieId;
use App\Media\Framework\Doctrine\DBAL\MovieIdDBALType;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class MovieIdDBALTypeTest extends TestCase
{
    use DoublesTrait;

    public function test_it_makes_an_entity_id_from_value_properly()
    {
        $id = $this->string()->uuid();

        $type = new MovieIdDBALType();
        $type = $type->makeFromValue($id);
        $this->assertInstanceOf(MovieId::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new MovieIdDBALType();
        $this->assertEquals('Media.MovieId', $type->getName());
    }
}
