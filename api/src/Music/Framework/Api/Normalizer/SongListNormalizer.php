<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\Normalizer;

use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class SongListNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = $this->denormalizer->denormalize($item, Song::class, $format, $context);
        }

        return SongList::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return SongList::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            SongList::class => true, // Supports SongList and result is cacheable
        ];
    }
}
