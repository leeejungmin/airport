<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields= {"email"},
 * message= "l'email que vous avez indique est deja utilise")
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

      /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="4", minMessage="Votre mot de passe doit fiare minimum 4")
     * @Assert\EqualTo(propertyPath="confirm_password")
     */
    private $password;
    /**
     * @Assert\EqualTo(propertyPath="password", message="vous n'avez pas tape le mem mot de passe" )
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="pilote")
     */
    private $pilote;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vol", inversedBy="passager")
     */
    private $passager;







    public function __construct()
    {
        $this->pilote = new ArrayCollection();
        $this->passager = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }




    /**
    * Returns the roles granted to the user.
    *
    *<code>
    *public function getRoles()
    *{
    *   return array('ROLE_USER');
    * }
    *</code>
    * Alternatively, the roles might be stored on a ``roles`` property,
    * and populated in any number of different ways when the user object
    * is created.
    *
    *@return array(Role|string)[] The user $roles
    */
    public function getRoles(): ?array
    {
        $tmRoles = $this->roles;

        // if(in_array(needle:'USER_ROLE',$tmpRoles === false){
          $tmpRoles[] = 'ROLE_USER';
        // })
        return $tmpRoles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function hasRole($role)
    {
      return in_array($role, $this->getRoles());
    }


    public function eraseCredentials() {}
    public function getSalt() {}

    /**
     * @return Collection|Vol[]
     */
    public function getPilote(): Collection
    {
        return $this->pilote;
    }

    public function addPilote(Vol $pilote): self
    {
        if (!$this->pilote->contains($pilote)) {
            $this->pilote[] = $pilote;
            $pilote->setPilote($this);
        }

        return $this;
    }

    public function removePilote(Vol $pilote): self
    {
        if ($this->pilote->contains($pilote)) {
            $this->pilote->removeElement($pilote);
            // set the owning side to null (unless already changed)
            if ($pilote->getPilote() === $this) {
                $pilote->setPilote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getPassager(): Collection
    {
        return $this->passager;
    }

    public function addPassager(Vol $passager): self
    {
        if (!$this->passager->contains($passager)) {
            $this->passager[] = $passager;
        }

        return $this;
    }

    public function removePassager(Vol $passager): self
    {
        if ($this->passager->contains($passager)) {
            $this->passager->removeElement($passager);
        }

        return $this;
    }



  
  }
