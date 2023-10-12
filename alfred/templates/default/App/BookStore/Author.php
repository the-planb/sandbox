<?php

return AggregateRoot('Author')
    ->with('name', Attribute('VO(FullName)')
        ->example([
            'firstName' => 'Mónica',
            'lastName' => 'Gutierrez Perez'
        ])
    );

