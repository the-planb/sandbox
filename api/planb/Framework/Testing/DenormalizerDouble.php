<?php

namespace PlanB\Framework\Testing;

use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DenormalizerDouble extends TestDouble
{

    public function __construct(callable $callback)
    {
        parent::__construct($callback, DenormalizerInterface::class);
    }

    protected function initialize(): void
    {

    }

    protected function configure(): void
    {
    }

    public function denormalizeByType(string $type, mixed $response = null): self
    {
        $response = $response ?? $this->stub($type);

        $this->double()
            ->denormalize(Argument::any(), $type, Argument::cetera())
            ->willReturn($response);

        return $this;
    }
}
