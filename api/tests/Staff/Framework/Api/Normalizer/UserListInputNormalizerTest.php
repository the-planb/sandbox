<?php

declare(strict_types=1);

namespace App\Tests\Staff\Framework\Api\Normalizer;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Input\UserListInput;
use App\Staff\Domain\Model\User;
use App\Staff\Framework\Api\Normalizer\UserListInputNormalizer;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
class UserListInputNormalizerTest extends TestCase
{
    use StaffTrait;

    public function test_it_denormalizes_properly()
    {
        $denormalizer = $this->prophesize(DenormalizerInterface::class);

        $denormalizer->denormalize(Argument::type('string'), User::class, Argument::cetera())
            ->willReturn($this->doubleUser())
            ->shouldBeCalledOnce()
        ;

        $denormalizer->denormalize(Argument::type('array'), UserInput::class, Argument::cetera())
            ->willReturn($this->doubleUserInput())
            ->shouldBeCalledOnce()
        ;

        $normalizer = new UserListInputNormalizer();
        $normalizer->setDenormalizer($denormalizer->reveal());

        $data = ['/uri', ['input', 'data']];

        $normalizer->denormalize($data, UserListInput::class);
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
        $normalizer = new UserListInputNormalizer();

        $this->assertEquals($expected, $normalizer->supportsDenormalization($data, $type));
    }

    public function dataProvider()
    {
        return [
            [['/uri', ['input', 'data']], UserListInput::class, true],
            ['no-array', UserListInput::class, false],
            [['/uri', ['input', 'data']], self::class, false],
        ];
    }

    public function test_get_supported_type_returns_the_correct_value()
    {
        $normalizer = new UserListInputNormalizer();
        $this->assertEquals([
            UserListInput::class => true,
        ], $normalizer->getSupportedTypes());
    }
}
