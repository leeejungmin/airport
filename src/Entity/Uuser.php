<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @UniqueEntity(
 * fields= {"email"},
 * message= "l'email que vous avez indique est deja utilise")
 * @ORM\Table(name="user")
 */
class Uuser implements UserInterface
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
     * @ORM\OneToOne(targetEntity="App\Entity\Pilote", cascade={"persist", "remove"})
     */
    private $pilote;








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
    *   return array('ROLE_PILOTE');
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
        $tmpRoles = $this->roles;
        // $tmpRoles = 'ROLE_PILOTE';
        // if(in_array($tmpRoles === 'ROLE_PILOTE'){
          $tmpRoles[] = 'ROLE_USER';
          // $tmpRoles[] = 'ROLE_PILOTE'
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
     * Generates the magic method
     *
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->username;
        // to show the id of the Category in the select
        // return $this->id;
    }

    public function getPilote(): ?Pilote
    {
        return $this->pilote;
    }

    public function setPilote(?Pilote $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }


  }
