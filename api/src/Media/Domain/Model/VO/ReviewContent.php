<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

use PlanB\Type\StringValue;
use PlanB\Validation\Traits\ValidableTrait;

class ReviewContent implements StringValue
{
    use ValidableTrait;
    private string $content;

    public function __construct(string $content)
    {
        $this->assert(content: $content);
        $this->content = $content;
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
