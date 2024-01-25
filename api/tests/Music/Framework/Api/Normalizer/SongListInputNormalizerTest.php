<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Api\Normalizer;

use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Song;
use App\Music\Framework\Api\Normalizer\SongListInputNormalizer;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class SongListInputNormalizerTest extends TestCase
{
    use MusicTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), Song::class, Argument::cetera())
            ->willReturn($this->doubleSong())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), SongInput::class, Argument::cetera())
            ->willReturn($this->doubleSongInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new SongListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, SongListInput::class);
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
        $normalizer = new SongListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], SongListInput::class, true],
            ['no-array', SongListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new SongListInputNormalizer();
        $this->assertEquals([
            SongListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
