<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Review;
use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use App\Media\Framework\Api\Normalizer\ReviewListInputNormalizer;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DenormalizerDouble;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
final class ReviewListInputNormalizerTest extends TestCase
{
    use DoublesTrait;
    private DenormalizerInterface $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = $this->createDouble(DenormalizerDouble::class)
            ->denormalizeByType(ReviewContent::class)
            ->denormalizeByType(Score::class)
            ->denormalizeByType(Review::class)
            ->reveal()
        ;
    }

    public function test_it_denormalize_from_iri_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new ReviewListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            $iri,
        ], ReviewListInput::class, $format);

        $this->assertInstanceOf(ReviewListInput::class, $list);
        $this->assertContainsOnlyInstancesOf(Review::class, $list);
    }

    public function test_it_denormalize_from_data_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new ReviewListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            [
                '@id' => $iri,
                'review' => $this->any(),
                'score' => $this->any(),
            ],
            [
                'review' => $this->any(),
                'score' => $this->any(),
            ],
        ], ReviewListInput::class, $format);

        $this->assertInstanceOf(ReviewListInput::class, $list);
        $this->assertInstanceOf(Review::class, $list->get(0));
        $this->assertIsArray($list->get(1));
    }

    /**
     * @dataProvider supportedProvider
     */
    public function test_it_supports_denormalization_properly(mixed $data, string $type, bool $expected)
    {
        $denormalizer = new ReviewListInputNormalizer();

        $response = $denormalizer->supportsDenormalization($data, $type, null);
        $this->assertEquals($expected, $response);
    }

    public function supportedProvider(): array
    {
        $rightData = $this->array()->dummy();
        $rightType = ReviewListInput::class;

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
        $denormalizer = new ReviewListInputNormalizer();
        $response = $denormalizer->getSupportedTypes();

        $this->assertEquals([
            ReviewListInput::class => true,
        ], $response);
    }
}
