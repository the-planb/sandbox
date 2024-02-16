<?php

declare(strict_types=1);

namespace App\Staff\Framework\EventListener;

use App\Staff\Domain\Model\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

final class JWTCreatedListener
{
    private RoleHierarchyInterface $roleHierarchy;

    public function __construct(RoleHierarchyInterface $roleHierarchy)
    {
        $this->roleHierarchy = $roleHierarchy;
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        if (!$user instanceof User) {
            return;
        }

        $data = $event->getData();
        $data['username'] = (string) $user->getName();
        $data['email'] = (string) $user->getEmail();
        $data['roles'] = $this->roleHierarchy->getReachableRoleNames($data['roles']);

        $event->setData($data);
    }
}
