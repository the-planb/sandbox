<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\Normalizer;

use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Song;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class SongListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, Song::class, $format, $context) :
                 $this->denormalizer->denormalize($item, SongInput::class, $format, $context);
        }

        return SongListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return SongListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            SongListInput::class => true, // Supports SongListInput and result is cacheable
        ];
    }
}
