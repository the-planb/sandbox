<?php

return ValueObject()
    ->with(Attribute('overview', 'text')
        ->constraint('Length', [
            'min'=>10
        ])
    );
