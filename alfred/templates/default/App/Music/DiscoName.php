<?php

return ValueObject('DiscoName')
    ->with('name', Attribute('string')
        ->constraint('Length', [
            'min' => 5
        ])
    );
