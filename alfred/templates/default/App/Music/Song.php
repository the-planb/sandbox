<?php


use PlanB\Alfred\Domain\Artefact\Dependency\Cascade;
use PlanB\Alfred\Domain\Artefact\Dependency\Fetch;

return Entity('Song')
    ->with('title', Attribute('VO(SongName)')
        ->example('the title')
    )
    ->with('duration', Attribute('VO(Duration)')
        ->example(120)
        ->nullable()
        ->defaultValue(null)

    )
    ->with('album', ManyToOne('Entity(Disco)')
        ->fetch(Fetch::EAGER)
        ->inversedBy('songs')
        ->cascade(Cascade::PERSIST)
    );

