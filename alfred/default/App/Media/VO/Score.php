<?php

return ValueObject()
    ->with(Attribute('score', 'int')
        ->constraint('Range', [
            'min' => 0,
            'max' => 10,
        ]));
