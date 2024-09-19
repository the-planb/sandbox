<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\ReviewId;
use App\Media\Framework\Doctrine\DBAL\ReviewIdDBALType;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class ReviewIdDBALTypeTest extends TestCase
{
    use DoublesTrait;

    public function test_it_makes_an_entity_id_from_value_properly()
    {
        $id = $this->string()->uuid();

        $type = new ReviewIdDBALType();
        $type = $type->makeFromValue($id);
        $this->assertInstanceOf(ReviewId::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new ReviewIdDBALType();
        $this->assertEquals('Media.ReviewId', $type->getName());
    }
}
