<?php

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

