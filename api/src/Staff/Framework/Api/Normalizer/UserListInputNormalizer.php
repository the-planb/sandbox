<?php

declare(strict_types=1);

namespace App\Staff\Framework\Api\Normalizer;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Input\UserListInput;
use App\Staff\Domain\Model\User;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class UserListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                 $this->denormalizer->denormalize($item, User::class, $format, $context) :
                 $this->denormalizer->denormalize($item, UserInput::class, $format, $context);
        }

        return UserListInput::collect($input);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return UserListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            UserListInput::class => true, // Supports UserListInput and result is cacheable
        ];
    }
}
