<?php

return AggregateRoot()
    ->with(Attribute('title', 'VO(Title)')
        ->nullable()
    );

