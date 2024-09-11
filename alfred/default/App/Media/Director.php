<?php

return AggregateRoot()
    ->with(Attribute('name', 'VO(FullName)'));
//    ->with(OneToMany('movies', 'Entity(Movie)')
//        ->nullable(true)
//        ->inputField(false)
//    );

