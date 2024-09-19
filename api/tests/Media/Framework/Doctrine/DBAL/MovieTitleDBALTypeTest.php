<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Framework\Doctrine\DBAL\MovieTitleDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class MovieTitleDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new MovieTitleDBALType();
        $this->assertInstanceOf(MovieTitleDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new MovieTitleDBALType();
        $this->assertEquals('Media.MovieTitle', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new MovieTitleDBALType();
        $this->assertEquals(MovieTitle::class, $type->getFqn());
    }
}
