<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Api\Normalizer;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Model\Disco;
use App\Music\Framework\Api\Normalizer\DiscoListInputNormalizer;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class DiscoListInputNormalizerTest extends TestCase
{
    use MusicTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), Disco::class, Argument::cetera())
            ->willReturn($this->doubleDisco())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), DiscoInput::class, Argument::cetera())
            ->willReturn($this->doubleDiscoInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new DiscoListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, DiscoListInput::class);
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
        $normalizer = new DiscoListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], DiscoListInput::class, true],
            ['no-array', DiscoListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new DiscoListInputNormalizer();
        $this->assertEquals([
            DiscoListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
