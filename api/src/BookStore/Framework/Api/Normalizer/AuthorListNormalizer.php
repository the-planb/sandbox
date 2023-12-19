<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class AuthorListNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = $this->denormalizer->denormalize($item, Author::class, $format, $context);
        }

        return AuthorList::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return AuthorList::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            AuthorList::class => true, // Supports AuthorList and result is cacheable
        ];
    }
}
