<?php

use PlanB\Alfred\Domain\Model\Dependency\Cascade;

return AggregateRoot()
    ->with(Attribute('title', 'VO(MovieTitle)'))
    ->with(Attribute('releaseYear', 'VO(ReleaseYear)'))
    ->with(ManyToOne('director', 'Entity(Director)')
        ->inversedBy('movies')
    )
    ->with(Composition('reviews', 'Entity(Review)'))

    ->with(ManyToMany('genres', 'Entity(Genre)')
        ->inversedBy('movies')
        ->nullable()
        ->cascade(Cascade::PERSIST)
    )
    ->with(Attribute('overview', 'VO(Overview)'))
    ->with(Attribute('classification', 'Enum(Classification)'))
    ->with(ServiceMethod('updateScore', 'Service(RateCalculator)')
        ->inputName('raw')
        ->outputName('koko')
    );
