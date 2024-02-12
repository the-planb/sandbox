<?php

return ValueObject('UserName')
    ->with('name', Attribute('string')
        ->constraint('Length', ['min' => 3])
    );
