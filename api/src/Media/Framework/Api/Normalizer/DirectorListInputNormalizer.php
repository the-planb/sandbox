<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\Normalizer;

use App\Media\Domain\Input\DirectorInput;
use App\Media\Domain\Input\DirectorListInput;
use App\Media\Domain\Model\Director;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DirectorListInputNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $input = [];
        foreach ($data as $item) {
            $input[] = is_string($item) ?
                $this->fromIri($item, $format, $context) :
                $this->fromData($item, $format, $context);
        }

        return DirectorListInput::collect($input);
    }

    public function fromIri(string $item, ?string $format, array $context): Director
    {
        return $this->denormalizer->denormalize($item, Director::class, $format, $context);
    }

    public function fromData(array $item, ?string $format, array $context): DirectorInput|Director
    {
        $input = $this->denormalizer->denormalize($item, DirectorInput::class, $format, $context);
        if (isset($item['@id'])) {
            $entity = $this->fromIri($item['@id'], $format, $context);

            return $entity->update(...$input->toArray());
        }

        return $input;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return DirectorListInput::class === $type and is_array($data);
    }

    public function getSupportedTypes(): array
    {
        return [
            DirectorListInput::class => true, // Supports DirectorListInput and result is cacheable
        ];
    }
}
