<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Tag;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class TagListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, Tag::class, $format, $context) :
                 $this->denormalizer->denormalize($item, TagInput::class, $format, $context);
        }

        return TagListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return TagListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            TagListInput::class => true, // Supports TagListInput and result is cacheable
        ];
    }
}
