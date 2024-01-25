<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\AuthorInput;
use App\BookStore\Domain\Input\AuthorListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Framework\Api\Normalizer\AuthorListInputNormalizer;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class AuthorListInputNormalizerTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), Author::class, Argument::cetera())
            ->willReturn($this->doubleAuthor())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), AuthorInput::class, Argument::cetera())
            ->willReturn($this->doubleAuthorInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new AuthorListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, AuthorListInput::class);
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
        $normalizer = new AuthorListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], AuthorListInput::class, true],
            ['no-array', AuthorListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new AuthorListInputNormalizer();
        $this->assertEquals([
            AuthorListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
