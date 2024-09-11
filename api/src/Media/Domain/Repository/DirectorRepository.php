<?php

declare(strict_types=1);

namespace App\Media\Domain\Repository;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\DirectorList;
use PlanB\Domain\Criteria\Criteria;

interface DirectorRepository
{
    public function save(Director $director): Director;

    public function delete(DirectorId $directorId): void;

    public function findById(DirectorId $directorId): ?Director;

    public function match(Criteria $criteria): DirectorList;
}
