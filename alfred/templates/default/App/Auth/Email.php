<?php

return ValueObject('Email')
    ->with('email', Attribute('string')
        ->constraint('Email', ['min' => 3])
    );
