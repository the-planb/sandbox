<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\FullName;

class Director
{
    private DirectorId $id;
    private FullName $name;

    public function __construct(FullName $name)
    {
        $this->id = new DirectorId();
        $this->name = $name;
    }

    public function update(FullName $name): Director
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): DirectorId
    {
        return $this->id;
    }

    public function getName(): FullName
    {
        return $this->name;
    }
}
