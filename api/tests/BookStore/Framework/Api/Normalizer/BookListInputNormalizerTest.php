<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\BookListInput;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Framework\Api\Normalizer\BookListInputNormalizer;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class BookListInputNormalizerTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), Book::class, Argument::cetera())
            ->willReturn($this->doubleBook())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), BookInput::class, Argument::cetera())
            ->willReturn($this->doubleBookInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new BookListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, BookListInput::class);
    }

    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     * @param mixed $type
     * @param mixed $expected
     */
    public function test_it_supports_denormalization_properly($data, $type, $expected)
    {
        $normalizer = new BookListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], BookListInput::class, true],
            ['no-array', BookListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new BookListInputNormalizer();
        $this->assertEquals([
            BookListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
