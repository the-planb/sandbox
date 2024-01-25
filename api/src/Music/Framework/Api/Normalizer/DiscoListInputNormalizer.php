<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\Normalizer;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Model\Disco;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DiscoListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, Disco::class, $format, $context) :
                 $this->denormalizer->denormalize($item, DiscoInput::class, $format, $context);
        }

        return DiscoListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return DiscoListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            DiscoListInput::class => true, // Supports DiscoListInput and result is cacheable
        ];
    }
}
