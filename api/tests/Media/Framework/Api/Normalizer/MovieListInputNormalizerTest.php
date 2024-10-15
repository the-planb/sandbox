<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\VO\Classification;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Framework\Api\Normalizer\MovieListInputNormalizer;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DenormalizerDouble;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
final class MovieListInputNormalizerTest extends TestCase
{
    use DoublesTrait;
    private DenormalizerInterface $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = $this->createDouble(DenormalizerDouble::class)
            ->denormalizeByType(MovieTitle::class)
            ->denormalizeByType(ReleaseYear::class)
            ->denormalizeByType(Director::class)
            ->denormalizeByType(ReviewListInput::class)
            ->denormalizeByType(GenreListInput::class)
            ->denormalizeByType(Overview::class)
            ->denormalizeByType(Classification::class)
            ->denormalizeByType(Movie::class)
            ->reveal()
        ;
    }

    public function test_it_denormalize_from_iri_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new MovieListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            $iri,
        ], MovieListInput::class, $format);

        $this->assertInstanceOf(MovieListInput::class, $list);
        $this->assertContainsOnlyInstancesOf(Movie::class, $list);
    }

    public function test_it_denormalize_from_data_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new MovieListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);

        $list = $denormalizer->denormalize([
            [
                '@id' => $iri,
                'title' => $this->any(),
                'releaseYear' => $this->any(),
                'director' => $this->any(),
                'reviews' => $this->any(),
                'genres' => $this->any(),
                'overview' => $this->any(),
                'classification' => $this->any(),
            ],
            [
                'title' => $this->any(),
                'releaseYear' => $this->any(),
                'director' => $this->any(),
                'reviews' => $this->any(),
                'genres' => $this->any(),
                'overview' => $this->any(),
                'classification' => $this->any(),
            ],
        ], MovieListInput::class, $format);

        $this->assertInstanceOf(MovieListInput::class, $list);
        $this->assertInstanceOf(Movie::class, $list->get(0));
        $this->assertIsArray($list->get(1));
    }

    /**
     * @dataProvider supportedProvider
     */
    public function test_it_supports_denormalization_properly(mixed $data, string $type, bool $expected)
    {
        $denormalizer = new MovieListInputNormalizer();

        $response = $denormalizer->supportsDenormalization($data, $type, null);
        $this->assertEquals($expected, $response);
    }

    public function supportedProvider(): array
    {
        $rightData = $this->array()->dummy();
        $rightType = MovieListInput::class;

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
        $denormalizer = new MovieListInputNormalizer();
        $response = $denormalizer->getSupportedTypes();

        $this->assertEquals([
            MovieListInput::class => true,
        ], $response);
    }
}
