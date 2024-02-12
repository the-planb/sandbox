<?php

declare(strict_types=1);

namespace App\Music\Domain\Repository;

use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Domain\Model\Song;
use PlanB\Domain\Model\Entity;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use PlanB\Domain\Criteria\Criteria;

interface DiscoRepository
{
    public function save(Disco $disco): Disco;

    public function delete(DiscoId $discoId): void;

    public function findById(DiscoId $discoId): ?Disco;


    /**
     * @param Criteria $criteria
     * @return DiscoList
     */
    public function match(Criteria $criteria): DiscoList;

    public function totalItems(): int;

}