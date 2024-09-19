<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\DirectorListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\VO\FullName;
use App\Media\Framework\Api\Normalizer\DirectorListInputNormalizer;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DenormalizerDouble;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @internal
 */
final class DirectorListInputNormalizerTest extends TestCase
{
    use DoublesTrait;
    private DenormalizerInterface $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = $this->createDouble(DenormalizerDouble::class)
            ->denormalizeByType(FullName::class)
            ->denormalizeByType(Director::class)
            ->reveal()
        ;
    }

    public function test_it_denormalize_from_iri_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new DirectorListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            $iri,
        ], DirectorListInput::class, $format);

        $this->assertInstanceOf(DirectorListInput::class, $list);
        $this->assertContainsOnlyInstancesOf(Director::class, $list);
    }

    public function test_it_denormalize_from_data_properly(): void
    {
        $iri = $this->string()->iri();
        $format = $this->string()->dummy();

        $denormalizer = new DirectorListInputNormalizer();
        $denormalizer->setDenormalizer($this->denormalizer);
        $list = $denormalizer->denormalize([
            [
                '@id' => $iri,
                'name' => $this->any(),
            ],
            [
                'name' => $this->any(),
            ],
        ], DirectorListInput::class, $format);

        $this->assertInstanceOf(DirectorListInput::class, $list);
        $this->assertInstanceOf(Director::class, $list->get(0));
        $this->assertIsArray($list->get(1));
    }

    /**
     * @dataProvider supportedProvider
     */
    public function test_it_supports_denormalization_properly(mixed $data, string $type, bool $expected)
    {
        $denormalizer = new DirectorListInputNormalizer();

        $response = $denormalizer->supportsDenormalization($data, $type, null);
        $this->assertEquals($expected, $response);
    }

    public function supportedProvider(): array
    {
        $rightData = $this->array()->dummy();
        $rightType = DirectorListInput::class;

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
        $denormalizer = new DirectorListInputNormalizer();
        $response = $denormalizer->getSupportedTypes();

        $this->assertEquals([
            DirectorListInput::class => true,
        ], $response);
    }
}
