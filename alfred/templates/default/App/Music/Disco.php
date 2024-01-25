<?php


use PlanB\Alfred\Domain\Artefact\Dependency\Cascade;
use PlanB\Alfred\Domain\Artefact\Dependency\Fetch;

return AggregateRoot('Disco')
    ->with('title', Attribute('VO(DiscoName)')
        ->example('the title')
    )
    ->with('songs', OneToMany('Entity(Song)')
        ->aggregate()
        ->orphanRemoval(true)
        ->fetch(Fetch::EAGER)
        ->mappedBy('album')
        ->cascade(Cascade::PERSIST)
    );
