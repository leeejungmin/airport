<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
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
    private $volnum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pilote")
     */
    private $pilote;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="passager")
     */
    private $passager;




    public function __construct()
    {
        $this->passager = new ArrayCollection();
    }




    public function getVolnum(): ?string
    {
        return $this->volnum;
    }

    public function setVolnum(string $volnum): self
    {
        $this->volnum = $volnum;

        return $this;
    }

    public function getPilote(): ?User
    {
        return $this->pilote;
    }

    public function setPilote(?User $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPassager(): Collection
    {
        return $this->passager;
    }

    public function addPassager(User $passager): self
    {
        if (!$this->passager->contains($passager)) {
            $this->passager[] = $passager;
            $passager->addPassager($this);
        }

        return $this;
    }

    public function removePassager(User $passager): self
    {
        if ($this->passager->contains($passager)) {
            $this->passager->removeElement($passager);
            $passager->removePassager($this);
        }

        return $this;
    }

    
}
