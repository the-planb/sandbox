<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\BookId;
use App\BookStore\Framework\Doctrine\DBAL\BookIdDBALType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class BookIdDBALTypeTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_converts_value_to_php_object_properly()
    {
        $platform = $this->prophesize(AbstractPlatform::class)
            ->reveal()
        ;

        $type = new BookIdDBALType();
        $bookId = $type->convertToPHPValue('018d92a8-3d51-60c7-93ba-4f655632e124', $platform);

        $this->assertInstanceOf(BookId::class, $bookId);
        $this->assertEquals('018d92a8-3d51-60c7-93ba-4f655632e124', (string) $bookId);
    }

    public function test_it_has_the_correct_name()
    {
        $type = new BookIdDBALType();
        $this->assertEquals('BookStore.BookId', $type->getName());
    }
}
