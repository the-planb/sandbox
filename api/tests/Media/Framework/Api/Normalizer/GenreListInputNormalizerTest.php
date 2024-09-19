<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\VO\GenreName;
use App\Media\Framework\Api\Normalizer\GenreListInputNormalizer;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DenormalizerDouble;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
final class GenreListInputNormalizerTest extends TestCase
{
    use DoublesTrait;
    private DenormalizerInterface $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = $this->createDouble(DenormalizerDouble::class)
            ->denormalizeByType(GenreName::class)
            ->denormalizeByType(Genre::class)
            ->reveal()
        ;
    }

    public function test_it_denormalize_from_iri_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new GenreListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            $iri,
        ], GenreListInput::class, $format);

        $this->assertInstanceOf(GenreListInput::class, $list);
        $this->assertContainsOnlyInstancesOf(Genre::class, $list);
    }

    public function test_it_denormalize_from_data_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new GenreListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            [
                '@id' => $iri,
                'name' => $this->any(),
            ],
            [
                'name' => $this->any(),
            ],
        ], GenreListInput::class, $format);

        $this->assertInstanceOf(GenreListInput::class, $list);
        $this->assertInstanceOf(Genre::class, $list->get(0));
        $this->assertIsArray($list->get(1));
    }

    /**
     * @dataProvider supportedProvider
     */
    public function test_it_supports_denormalization_properly(mixed $data, string $type, bool $expected)
    {
        $denormalizer = new GenreListInputNormalizer();

        $response = $denormalizer->supportsDenormalization($data, $type, null);
        $this->assertEquals($expected, $response);
    }

    public function supportedProvider(): array
    {
        $rightData = $this->array()->dummy();
        $rightType = GenreListInput::class;

        $wrongData = $this->string()->dummy();
        $wrongType = $this->string()->dummy();

        return [
            [$rightData, $rightType, true],
            [$rightData, $wrongType, false],
            [$wrongData, $rightType, false],
            [$wrongData, $wrongType, false],
        ];
    }

    public function test_get_supported_types_is_properly_configured()
    {
        $denormalizer = new GenreListInputNormalizer();
        $response = $denormalizer->getSupportedTypes();

        $this->assertEquals([
            GenreListInput::class => true,
        ], $response);
    }
}
