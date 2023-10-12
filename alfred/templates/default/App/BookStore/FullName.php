<?php

return ValueObject('FullName')
    ->with('firstName', Attribute('string')
        ->constraint('Length', ['min' => 3])
    )
    ->with('lastName', Attribute('string')
        ->constraint('Length', ['min' => 3])
    );
