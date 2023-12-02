<?php

return ValueObject('TagName')
    ->with('name', Attribute('string')
        ->constraint('Length', [
            'min' => 3
        ])
    );
