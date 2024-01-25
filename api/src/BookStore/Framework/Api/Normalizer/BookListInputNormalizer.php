<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\BookListInput;
use App\BookStore\Domain\Model\Book;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class BookListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, Book::class, $format, $context) :
                 $this->denormalizer->denormalize($item, BookInput::class, $format, $context);
        }

        return BookListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return BookListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            BookListInput::class => true, // Supports BookListInput and result is cacheable
        ];
    }
}
