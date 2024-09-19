<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\Native;

use Symfony\Component\Uid\Uuid;

final class StringDummy
{

    public function dummy(): string
    {
        return "cadena";
    }

    public function uuid(): string
    {
        return Uuid::v6()->toRfc4122();
    }

    public function iri(): string
    {
        return "api/resource/{$this->uuid()}";
    }
}
