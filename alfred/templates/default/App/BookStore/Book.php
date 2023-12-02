<?php


use PlanB\Alfred\Domain\Artefact\Dependency\Cascade;
use PlanB\Alfred\Domain\Artefact\Dependency\Fetch;

return AggregateRoot('Book')
    ->with('title', Attribute('VO(Title)')
        ->example('the title')
    )
    ->with('price', Attribute('VO(Price)')
        ->example(1400)
        ->nullable()
    )
    ->with('author', ManyToOne('Entity(Author)')
        ->fetch(Fetch::EAGER)
//        ->inversedBy('author')
        ->cascade(Cascade::PERSIST)
    )
    ->with('tags', ManyToMany('Entity(Tag)')
//        ->inversedBy('id')
        ->fetch(Fetch::EAGER)
        ->cascade(Cascade::PERSIST)
    );
