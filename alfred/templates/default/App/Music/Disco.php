<?php


use PlanB\Alfred\Domain\Artefact\Dependency\Cascade;
use PlanB\Alfred\Domain\Artefact\Dependency\Fetch;
use PlanB\Alfred\Domain\Type\Native;

return AggregateRoot('Disco')
    ->with('title', Attribute('VO(DiscoName)')
        ->example('the title')
    )
    ->with('songs', OneToMany('Entity(Song)')
        ->fetch(Fetch::EAGER)
        ->mappedBy('album')
        ->cascade(Cascade::PERSIST)
    );
