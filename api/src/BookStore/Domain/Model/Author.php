<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Model\VO\FullName;

class Author
{
    private AuthorId $id;
    private FullName $name;

    public function __construct(FullName $name)
    {
        $this->id = new AuthorId();
        $this->name = $name;
    }

    public function update(FullName $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): FullName
    {
        sleep(2);

        return $this->name;
    }
}
