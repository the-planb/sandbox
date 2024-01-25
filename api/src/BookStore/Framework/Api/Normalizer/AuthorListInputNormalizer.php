<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\Normalizer;

use App\BookStore\Domain\Input\AuthorInput;
use App\BookStore\Domain\Input\AuthorListInput;
use App\BookStore\Domain\Model\Author;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class AuthorListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, Author::class, $format, $context) :
                 $this->denormalizer->denormalize($item, AuthorInput::class, $format, $context);
        }

        return AuthorListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return AuthorListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            AuthorListInput::class => true, // Supports AuthorListInput and result is cacheable
        ];
    }
}
