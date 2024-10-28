<?php

declare(strict_types=1);

namespace App\Auth\Framework\Api\Normalizer;

use App\Auth\Domain\Input\UserInput;
use App\Auth\Domain\Input\UserListInput;
use App\Auth\Domain\Model\User;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class UserListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
	use DenormalizerAwareTrait;

	public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
	{
		$input = [];
		foreach ($data as $item) {
			$input[] = is_string($item) ?
				$this->denormalizer->denormalize($item, User::class, $format, $context) :
				$this->denormalizer->denormalize($item, UserInput::class, $format, $context);
		}

		return UserListInput::collect($input);
	}

	public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
	{
		return UserListInput::class === $type and is_array($data);
	}

	public function getSupportedTypes(?string $format): array
	{
		return [
			UserListInput::class => true, // Supports UserListInput and result is cacheable
		];
	}
}
