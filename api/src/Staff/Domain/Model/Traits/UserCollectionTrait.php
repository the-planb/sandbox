<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model\Traits;

use App\Staff\Domain\Input\UserListInput;
use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserList;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait UserCollectionTrait
{
    private Collection $users;

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function createUser(UserName $name, Email $email): static
    {
        $user = new User($name, $email);
        $this->users->add($user);

        return $this;
    }

    public function addUser(User $user): self
    {
        $this->users->add($user);

        return $this;
    }

    public function getUsers(): UserList
    {
        return UserList::collect($this->users ?? []);
    }

    private function userCollection(UserListInput $input): static
    {
        $this->users ??= new ArrayCollection();
        $input
            ->remove($this->removeUser(...))
            ->create($this->createUser(...))
            ->add($this->addUser(...))
            ->with(EntityList::collect($this->users))
        ;

        return $this;
    }
}
