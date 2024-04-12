<?php

return ValueObject()
    ->with(Attribute('year', 'int')
        ->constraint('Range', [
            'min' => 1900
        ])
    )
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
