<?php

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

return AggregateRoot('User')
    ->implements(...[
        UserInterface::class,
        PasswordAuthenticatedUserInterface::class
    ],
    )
    ->with('name', Attribute('VO(UserName)')
        ->example([
            'name' => 'Mónica'
        ])
    )
    ->with('email', Attribute('VO(Email)')
        ->example([
            'name' => 'monica@example.com'
        ])
    );

