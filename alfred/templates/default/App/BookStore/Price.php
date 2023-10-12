<?php

return ValueObject('Price')
    ->with('amount', Attribute('int')
        ->constraint('Type', ['int'])
        ->constraint('Range', [
            'min' => 10
        ])
//        ->constraints([
//            'Type' => 'int',
//            'Range' => [
//                'min' => 10
//            ]
//        ])
        ->nullable());
