<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\GenreName;
use App\Media\Framework\Doctrine\DBAL\GenreNameDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class GenreNameDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new GenreNameDBALType();
        $this->assertInstanceOf(GenreNameDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new GenreNameDBALType();
        $this->assertEquals('Media.GenreName', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new GenreNameDBALType();
        $this->assertEquals(GenreName::class, $type->getFqn());
    }
}
