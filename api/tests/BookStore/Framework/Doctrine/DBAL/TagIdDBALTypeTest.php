<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\TagId;
use App\BookStore\Framework\Doctrine\DBAL\TagIdDBALType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class TagIdDBALTypeTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_converts_value_to_php_object_properly()
    {
        $platform = $this->prophesize(AbstractPlatform::class)
            ->reveal()
        ;

        $type = new TagIdDBALType();
        $tagId = $type->convertToPHPValue('018d92a8-3d51-60c7-93ba-4f655632e124', $platform);

        $this->assertInstanceOf(TagId::class, $tagId);
        $this->assertEquals('018d92a8-3d51-60c7-93ba-4f655632e124', (string) $tagId);
    }

    public function test_it_has_the_correct_name()
    {
        $type = new TagIdDBALType();
        $this->assertEquals('BookStore.TagId', $type->getName());
    }
}
