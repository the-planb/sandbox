<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookList;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class BookListNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = $this->denormalizer->denormalize($item, Book::class, $format, $context);
        }

        return BookList::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return BookList::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            BookList::class => true, // Supports BookList and result is cacheable
        ];
    }
}
