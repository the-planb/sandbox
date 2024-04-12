<?php

return ValueObject()
    ->with(Attribute('name', 'string'))
//    ->with(ManyToOne('category', 'Entity(Category)')
//        ->nullable()
//        ->cascade(Cascade::PERSIST)
//    )
//    ->with(ManyToMany('tags', 'Entity(Tag)')
//        ->nullable()
//        ->cascade(Cascade::PERSIST)
//    )
//    ->with(ServiceMethod('updatePrice', 'Service(PriceCalculator)')
//        ->inputName('originalPrice')
//    )

    ;
