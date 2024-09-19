<?php

use PlanB\Alfred\Domain\Model\Dependency\Cascade;

return AggregateRoot()
    ->with(Attribute('name', 'VO(GenreName)'))
//    ->with(ManyToMany('movies', 'Entity(Movie)')
//
//        ->inversedBy('genres')
//        ->mappedBy('movies')
//        ->nullable()
//        ->cascade(Cascade::PERSIST)
//        ->inputField(false)
//    )

    ;

