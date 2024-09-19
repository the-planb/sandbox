<?php

return ValueObject()
    ->with(Attribute('name', 'string')
        ->constraint('Length', ['min' => 3])
    )
    ->with(Attribute('lastName', 'string')
        ->constraint('Length', ['min' => 3])
    );
