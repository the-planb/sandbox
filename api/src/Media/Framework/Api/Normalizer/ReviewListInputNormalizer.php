<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Review;
use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class ReviewListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                $this->fromIri($item, $format, $context) :
                $this->fromData($item, $format, $context);
        }

        return ReviewListInput::collect($input);
    }

    private function fromIri(string $item, string $format, array $context): Review
    {
        return $this->denormalizer->denormalize($item, Review::class, $format, $context);
    }

    private function fromData(array $item, string $format, array $context): array|Review
    {
        // adios
        $input = [
            'review' => $this->denormalizer->denormalize($item['review'], ReviewContent::class, $format, $context),
            'score' => $this->denormalizer->denormalize($item['score'], Score::class, $format, $context),
        ];
        if (isset($item['@id'])) {
            $entity = $this->fromIri($item['@id'], $format, $context);

            return $entity->update(...$input);
        }

        return $input;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return ReviewListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            ReviewListInput::class => true, // Supports ReviewListInput and result is cacheable
        ];
    }
}
