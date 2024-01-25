<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Framework\Api\Normalizer\TagListInputNormalizer;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class TagListInputNormalizerTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), Tag::class, Argument::cetera())
            ->willReturn($this->doubleTag())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), TagInput::class, Argument::cetera())
            ->willReturn($this->doubleTagInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new TagListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, TagListInput::class);
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
        $normalizer = new TagListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], TagListInput::class, true],
            ['no-array', TagListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new TagListInputNormalizer();
        $this->assertEquals([
            TagListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
