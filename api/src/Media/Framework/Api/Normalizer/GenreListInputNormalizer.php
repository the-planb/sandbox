<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\GenreInput;
use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Model\Genre;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class GenreListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
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

        return GenreListInput::collect($input);
    }

    public function fromIri(string $item, ?string $format, array $context): Genre
    {
        return $this->denormalizer->denormalize($item, Genre::class, $format, $context);
    }

    public function fromData(array $item, ?string $format, array $context): GenreInput|Genre
    {
        $input = $this->denormalizer->denormalize($item, GenreInput::class, $format, $context);
        if (isset($item['@id'])) {
            $entity = $this->fromIri($item['@id'], $format, $context);

            return $entity->update(...$input->toArray());
        }

        return $input;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return GenreListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            GenreListInput::class => true, // Supports GenreListInput and result is cacheable
        ];
    }
}
