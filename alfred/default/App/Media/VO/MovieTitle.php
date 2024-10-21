<?php

return ValueObject()
    ->with(Attribute('title', 'string')
        ->example('el padrino')
        ->constraint('Length', [
            'min' => 3
        ])
    );
