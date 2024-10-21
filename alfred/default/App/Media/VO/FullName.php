<?php

return ValueObject()
    ->with(Attribute('name', 'string')
        ->example('pepe')
        ->constraint('Length', ['min' => 3])
    )
    ->with(Attribute('lastName', 'string')
        ->example('gonzalez')
        ->constraint('Length', ['min' => 3])
    );
