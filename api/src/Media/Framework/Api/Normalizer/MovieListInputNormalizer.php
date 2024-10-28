<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\VO\Classification;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class MovieListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
	use DenormalizerAwareTrait;

	public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
	{
		$input = [];
		foreach ($data as $item) {
			$input[] = is_string($item) ?
				   $this->fromIri($item, $format, $context) :
				$this->fromData($item, $format, $context);
		}

		return MovieListInput::collect($input);
	}

	private function fromIri(string $item, string $format, array $context): Movie
	{
		return $this->denormalizer->denormalize($item, Movie::class, $format, $context);
	}

	private function fromData(array $item, string $format, array $context): array|Movie
	{
		$input = [
			'title' => $this->denormalizer->denormalize($item['title'], MovieTitle::class, $format, $context),
			'releaseYear' => $this->denormalizer->denormalize($item['releaseYear'], ReleaseYear::class, $format, $context),
			'director' => $this->denormalizer->denormalize($item['director'], Director::class, $format, $context),
			'reviews' => $this->denormalizer->denormalize($item['reviews'], ReviewListInput::class, $format, $context),
			'genres' => $this->denormalizer->denormalize($item['genres'], GenreListInput::class, $format, $context),
			'overview' => $this->denormalizer->denormalize($item['overview'], Overview::class, $format, $context),
			'classification' => $this->denormalizer->denormalize($item['classification'], Classification::class, $format, $context),
		];
		if (isset($item['@id'])) {
			$entity = $this->fromIri($item['@id'], $format, $context);

			return $entity->update(...$input);
		}

		return $input;
	}

	public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
	{
		return MovieListInput::class === $type and is_array($data);
	}

	public function getSupportedTypes(?string $format = null): array
	{
		return [
			MovieListInput::class => true, // Supports MovieListInput and result is cacheable
		];
	}
}
