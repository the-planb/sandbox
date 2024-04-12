<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\MovieInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\Movie;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class MovieListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
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

        return MovieListInput::collect($input);
    }

    public function fromIri(string $item, ?string $format, array $context): Movie
    {
        return $this->denormalizer->denormalize($item, Movie::class, $format, $context);
    }

    public function fromData(array $item, ?string $format, array $context): MovieInput|Movie
    {
        $input = $this->denormalizer->denormalize($item, MovieInput::class, $format, $context);
        if (isset($item['@id'])) {
            $entity = $this->fromIri($item['@id'], $format, $context);

            return $entity->update(...$input->toArray());
        }

        return $input;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return MovieListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            MovieListInput::class => true, // Supports MovieListInput and result is cacheable
        ];
    }
}
