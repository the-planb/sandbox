<?php

return ValueObject('Duration')
    ->with('duration', Attribute('int')
        ->constraint('GreaterThan', [
            'value' => 0
        ])
    );
