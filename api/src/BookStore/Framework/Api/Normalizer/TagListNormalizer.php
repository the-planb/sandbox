<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class TagListNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = $this->denormalizer->denormalize($item, Tag::class, $format, $context);
        }

        return TagList::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return TagList::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            TagList::class => true, // Supports TagList and result is cacheable
        ];
    }
}
