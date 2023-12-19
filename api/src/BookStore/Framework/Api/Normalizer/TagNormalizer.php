<?php

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class TagNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        foreach ($data as $item) {
            $tags[] = $this->denormalizer->denormalize($item, Tag::class, $format, $context);
        }

        return TagList::collect($tags);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return TagList::class === $type and is_array($data);
    }

    public function getSupportedTypes()
    {
        return [
            TagList::class => true, // Supports TagList and result is cacheable
        ];
    }
}
