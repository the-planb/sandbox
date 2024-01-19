<?php

return ValueObject('SongName')
    ->with('name', Attribute('string')
        ->constraint('Length', [
            'min' => 5
        ])
    );
