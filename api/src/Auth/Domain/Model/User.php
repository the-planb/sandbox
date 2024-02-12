<?php
declare(strict_types=1);

namespace App\Auth\Domain\Model;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use PlanB\Domain\Model\Entity;

use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Model\VO\UserName;
use App\Auth\Domain\Model\VO\Email;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    
    

class User implements UserInterface, PasswordAuthenticatedUserInterface implements Entity
{
    

    private UserId $id;
    private UserName $name;
private Email $email;

    public function __construct(UserName $name, Email $email){
        $this->id = new UserId();
        $this->name = $name;
$this->email = $email;
    }

    public function update(UserName $name, Email $email): self{
        $this->name = $name;
$this->email = $email;
        return $this;
    }

        public function getId(): UserId
    { 
        return $this->id;
    }
    public function getName(): UserName
    { 
        return $this->name;
    }
    public function getEmail(): Email
    { 
        return $this->email;
    }
}
