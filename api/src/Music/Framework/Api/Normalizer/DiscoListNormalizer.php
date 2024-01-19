<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\Normalizer;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DiscoListNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = $this->denormalizer->denormalize($item, Disco::class, $format, $context);
        }

        return DiscoList::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return DiscoList::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            DiscoList::class => true, // Supports DiscoList and result is cacheable
        ];
    }
}
