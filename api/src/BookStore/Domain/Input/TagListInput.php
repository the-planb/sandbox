<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Input;

use App\BookStore\Domain\Model\Tag;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(TagInput::class, Tag::class)]
final class TagListInput extends InputList
{
}
