<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Model\VO\TagName;

class Tag
{
    private TagId $id;
    private TagName $name;

    public function __construct(TagName $name)
    {
        $this->id = new TagId();
        $this->name = $name;
    }

    public function update(TagName $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): TagId
    {
        return $this->id;
    }

    public function getName(): TagName
    {
        return $this->name;
    }
}
