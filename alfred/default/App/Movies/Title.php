<?php

return ValueObject()
    ->with(Attribute('title', 'string')
        ->constraint('Length', ['min' => '3'])
        ->default('el título')
        ->nullable()
    );

