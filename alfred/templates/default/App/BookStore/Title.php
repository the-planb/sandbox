<?php

return ValueObject('Title')
    ->with('title', Attribute('string')
        ->constraint('Length', [
            'min' => 10
        ])
    );
