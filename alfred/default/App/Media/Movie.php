<?php

use PlanB\Alfred\Domain\Model\Dependency\Cascade;

return AggregateRoot()
    ->with(Attribute('title', 'VO(MovieTitle)'))
    ->with(Attribute('releaseYear', 'VO(ReleaseYear)'))
    ->with(ManyToOne('director', 'Entity(Director)')
//        ->inversedBy('movies')
        ->cascade(Cascade::PERSIST)
    )
//    ->with(OneToMany('reviews', 'Entity(Review)')
//        ->nullable(true)
//        ->inversedBy('movie')
//        ->orphanRemoval(true)
//        ->cascade(Cascade::PERSIST, Cascade::REMOVE)
//    )
//    ->with(ManyToMany('genres', 'Entity(Genre)')
//        ->joinTable('media_movie_genre')
//        ->inversedBy('movies')
//        ->nullable()
//        ->cascade(Cascade::PERSIST)
//    )
    ->with(Attribute('overview', 'VO(Overview)'));
