<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Framework\Doctrine\DBAL\ReviewContentDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ReviewContentDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new ReviewContentDBALType();
        $this->assertInstanceOf(ReviewContentDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new ReviewContentDBALType();
        $this->assertEquals('Media.ReviewContent', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new ReviewContentDBALType();
        $this->assertEquals(ReviewContent::class, $type->getFqn());
    }
}
